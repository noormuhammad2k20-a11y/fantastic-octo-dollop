<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\ConversionLog;
use App\Services\ProcessorFactory;
use App\Services\Seo\SeoSchemaGenerator;


class ToolController extends Controller
{
    /**
     * Display a tool page.
     */
    public function show(string $slug, string $params = null)
    {
        $tools = config('tools.tools');
        $proCalculators = config('pro_calculators') ?? [];
        $categories = config('tools.categories');

        // Check if slug is a tool
        if (isset($proCalculators[$slug]) || isset($tools[$slug])) {
            $tool = $proCalculators[$slug] ?? $tools[$slug];
            $tool['slug'] = $slug;
            
            // AUTOMATED SEO GENERATION (If missing or sub-optimal)
            if (empty($tool['description']) || mb_strlen($tool['description'] ?? '') < 50) {
                $tool['description'] = \App\Services\Seo\SeoAutoGenerator::generateDescription($tool);
            }
            if (empty($tool['title']) || mb_strlen($tool['title'] ?? '') < 50) {
                $tool['title'] = \App\Services\Seo\SeoAutoGenerator::generateTitle($tool);
            }
            
            // Auto-generate FAQ and Instructions
            $autoFaq = \App\Services\Seo\SeoAutoGenerator::generateFaq($tool);
            if (empty($tool['custom_faq'])) {
                $tool['custom_faq'] = $autoFaq;
            } else {
                $currentCount = count($tool['custom_faq']);
                if ($currentCount < 7) {
                    $needed = 7 - $currentCount;
                    $tool['custom_faq'] = array_merge($tool['custom_faq'], array_slice($autoFaq, 0, $needed));
                }
            }
            if (empty($tool['instructions'])) {
                $tool['instructions'] = \App\Services\Seo\SeoAutoGenerator::generateInstructions($tool);
            }

            // Track the tool view dynamically
            try {
                \App\Models\ToolAnalytics::firstOrCreate(['tool_slug' => $slug])->increment('view_count');
            } catch (\Exception $e) { \Illuminate\Support\Facades\Log::warning('ToolAnalytics tracking failed: ' . $e->getMessage()); }

            // Add Structured Data (JSON-LD @graph — unified schema)
            $categoryData = $categories[$tool['category'] ?? ''] ?? null;
            $faqData = $tool['custom_faq'] ?? null;
            $schemaGenerator = new SeoSchemaGenerator();
            $schemaMarkup = $schemaGenerator->generate($tool, url()->current(), $faqData, $categoryData);
            View::share('schemaMarkup', $schemaMarkup);

            // Load approved SEO content
            $seoDraft = \App\Models\ContentDraft::where('tool_slug', $tool['slug'])
                ->where('status', 'approved')
                ->select(['draft_content', 'outline_json', 'word_count'])
                ->first();

            // Load related tools from internal_links
            $relatedTools = \Illuminate\Support\Facades\DB::table('internal_links as il')
                ->join('tool_health_checks as t', 't.tool_slug', '=', 'il.target_tool_slug')
                ->where('il.source_tool_slug', $tool['slug'])
                ->where('il.is_active', 1)
                ->orderByDesc('il.relevance_score')
                ->limit(6)
                ->select([
                    't.tool_slug',
                    'il.anchor_text_primary',
                    'il.relevance_score',
                ])
                ->get();

            // Load PAA questions for this tool
            $paaQuestions = \Illuminate\Support\Facades\DB::table('semantic_keywords')
                ->where('tool_slug', $tool['slug'])
                ->where('keyword_type', 'paa')
                ->where('is_active', 1)
                ->pluck('keyword');


            return view('tools.tool', compact('tool', 'slug', 'tools', 'schemaMarkup', 'seoDraft', 'relatedTools', 'paaQuestions'));


        }

        abort(404);
    }

    /**
     * Process an uploaded file via AJAX.
     */
    public function process(Request $request, string $slug)
    {
        // Increase limits for large file processing
        ini_set('memory_limit', '1024M');
        set_time_limit(600); // 10 minutes for heavy video/PDF logic

        $tools = config('tools.tools');
        $proCalculators = config('pro_calculators') ?? [];

        if (!isset($proCalculators[$slug]) && !isset($tools[$slug])) {
            return response()->json(['success' => false, 'message' => 'Tool not found.'], 404);
        }

        $toolConfig = $proCalculators[$slug] ?? $tools[$slug];
        $processor = $toolConfig['processor'] ?? 'utility';

        // STRICT FILE LIMIT ENFORCEMENT (Mirroring Frontend)
        // STRICT FILE LIMIT ENFORCEMENT
        $maxMB = 10;
        $maxKB = $maxMB * 1024;
        $request->validate([
            'file' => 'nullable|file|max:' . $maxKB,
            'files' => 'nullable|array',
            'files.*' => 'file|max:' . $maxKB,
        ]);

        $files = $request->hasFile('files') ? $request->file('files') : [$request->file('file')];
        $results = [];
        $isCollective = $toolConfig['collective'] ?? false;

        // Extract options from request (everything except file/files)
        $options = $request->except(['file', 'files']);

        if ($isCollective && count($files) > 0) {
            $tempPaths = [];
            $totalOriginalSize = 0;
            $originalNames = [];
            $startTime = microtime(true);

            foreach ($files as $file) {
                if (!$file) continue;
                $originalNames[] = $file->getClientOriginalName();
                $totalOriginalSize += $file->getSize();
                $tempPaths[] = $file->store('uploads/temp', 'public');
            }

            try {
                $processor = ProcessorFactory::make($toolConfig['processor']);
                $result = $processor->process($tempPaths, $slug, $options);

                foreach ($tempPaths as $path) Storage::disk('public')->delete($path);

                if (!$result['success']) {
                    return response()->json(['success' => false, 'message' => $result['message'] ?? 'Processing failed.'], 400);
                }

                $processedSize = $result['processed_size'];
                $processedFilename = $result['processed_filename'];
                $processingTime = round((microtime(true) - $startTime) * 1000);

                $this->logConversion($slug, implode(', ', $originalNames), $totalOriginalSize, $processedSize, $processingTime, $request);

                $results[] = [
                    'success' => true,
                    'name' => 'Combined Result',
                    'original_size' => $totalOriginalSize,
                    'new_size' => $processedSize,
                    'reduction_percent' => $totalOriginalSize > 0 ? round((1 - ($processedSize / $totalOriginalSize)) * 100, 1) : 0,
                    'processing_time_ms' => $processingTime,
                    'download_url' => route('tool.download', ['filename' => $processedFilename]),
                    'processed_path' => $result['processed_path'] ?? null,
                    'processed_filename' => $processedFilename,
                ];
            } catch (\Exception $e) {
                Log::error("Collective tool processing error (slug: {$slug}): " . $e->getMessage());
                foreach ($tempPaths as $path) Storage::disk('public')->delete($path);
                return response()->json(['success' => false, 'message' => 'Processing failed: ' . $e->getMessage()], 500);
            }
        } else {
            foreach ($files as $file) {
                if (!$file) continue;

                $originalName = $file->getClientOriginalName();
                $originalSize = $file->getSize();
                $startTime = microtime(true);

                // Store the uploaded file temporarily
                $tempPath = $file->store('uploads/temp', 'public');

                try {
                    // Get appropriate processor from factory
                    $processor = ProcessorFactory::make($toolConfig['processor']);

                    // Run processing
                    $result = $processor->process($tempPath, $slug, $options);

                    if (!$result['success']) {
                        Storage::disk('public')->delete($tempPath);
                        $results[] = [
                            'success' => false,
                            'name' => $originalName,
                            'message' => $result['message'] ?? 'Processing failed.'
                        ];
                        continue;
                    }

                    $processedSize = $result['processed_size'];
                    $processedFilename = $result['processed_filename'];
                    $processingTime = round((microtime(true) - $startTime) * 1000);

                    // Debug Log
                    \Log::info("Tool Process [{$slug}]: original={$originalName}, processed={$processedFilename}, size={$processedSize}");

                    // Log the conversion
                    $this->logConversion($slug, $originalName, $originalSize, $processedSize, $processingTime, $request);

                    // Clean up the temp file
                    Storage::disk('public')->delete($tempPath);

                    $results[] = [
                        'success' => true,
                        'name' => $originalName,
                        'original_size' => $originalSize,
                        'new_size' => $processedSize,
                        'reduction_percent' => $originalSize > 0 ? round((1 - ($processedSize / $originalSize)) * 100, 1) : 0,
                        'processing_time_ms' => $processingTime,
                        'download_url' => route('tool.download', ['filename' => $processedFilename]),
                        'processed_path' => $result['processed_path'] ?? null,
                        'processed_filename' => $processedFilename,
                    ];
                } catch (\Exception $e) {
                    Log::error("Tool processing error (slug: {$slug}): " . $e->getMessage());
                    if (isset($tempPath)) Storage::disk('public')->delete($tempPath);

                    $results[] = [
                        'success' => false,
                        'name' => $originalName,
                        'message' => 'Processing failed: ' . $e->getMessage()
                    ];
                }
            }
        }

        $allSuccessful = count($results) > 0 && collect($results)->every('success', true);

        return response()->json([
            'success' => $allSuccessful,
            'message' => $allSuccessful 
                ? (count($results) > 1 ? 'Files processed' : 'File processed')
                : ($results[0]['message'] ?? 'Processing failed'),
            'results' => $results,
            // Maintain backward compatibility for single file response
            'download_url' => $results[0]['download_url'] ?? null,
            'processed_path' => $results[0]['processed_path'] ?? null,
            'processed_filename' => $results[0]['processed_filename'] ?? null,
            'original_name' => $results[0]['name'] ?? null,
            'original_size' => $results[0]['original_size'] ?? null,
            'new_size' => $results[0]['new_size'] ?? null,
        ], $allSuccessful ? 200 : 400);
    }

    /**
     * Preview a processed file (non-destructive).
     */
    public function preview(string $filename)
    {
        $path = 'uploads/processed/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        $fullPath = Storage::disk('public')->path($path);
        
        return response()->file($fullPath);
    }

    /**
     * Download a processed file.
     */
    public function download(string $filename)
    {
        $path = 'uploads/processed/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found or has already been downloaded.');
        }

        $fullPath = Storage::disk('public')->path($path);
        
        // Detect actual MIME type from file content
        $mimeType = Storage::disk('public')->mimeType($path);
        
        // Extract extension from filename or fallback to extension from MIME type
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (empty($extension)) {
            $extension = match ($mimeType) {
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
                'image/gif' => 'gif',
                'application/pdf' => 'pdf',
                'audio/mpeg' => 'mp3',
                'video/mp4' => 'mp4',
                default => ''
            };
        }

        // Clean up the filename for the user
        $originalName = preg_replace('/^processed_[a-zA-Z0-9]{10}_/', '', $filename);
        
        // If the name is a raw UUID or looks malformed, use a clean fallback
        if (preg_match('/^[0-9a-f-]{36}$/i', $originalName) || empty($originalName) || strlen($originalName) < 5) {
            $originalName = 'converted-hd-image';
        }

        // Ensure the correct extension is appended for OS recognition
        if (!empty($extension) && !str_ends_with(strtolower($originalName), '.' . $extension)) {
            $originalName .= '.' . $extension;
        }

        // Explicitly set headers for Content-Type and Content-Disposition
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $originalName . '"',
        ];

        return response()->download($fullPath, $originalName, $headers);
    }

    /**
     * Check URL Redirects (Webmaster Tool Backend)
     */
    public function checkRedirect(Request $request)
    {
        $url = $request->input('url');
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return response()->json(['success' => false, 'message' => 'Invalid URL provided.'], 400);
        }

        try {
            $chain = [];
            $currentUrl = $url;
            $maxRedirects = 10;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

            while ($maxRedirects-- > 0) {
                curl_setopt($ch, CURLOPT_URL, $currentUrl);
                $response = curl_exec($ch);
                if ($response === false) {
                    $chain[] = ['url' => $currentUrl, 'status' => 'Error: ' . curl_error($ch)];
                    break;
                }

                $info = curl_getinfo($ch);
                $status = $info['http_code'];
                $chain[] = ['url' => $currentUrl, 'status' => $status];

                if ($status >= 300 && $status < 400) {
                    // Find 'Location' header
                    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                    $header = substr($response, 0, $headerSize);
                    if (preg_match('/^Location:\s*(.*)$/mi', $header, $matches)) {
                        $nextUrl = trim($matches[1]);
                        // Handle relative URLs
                        if (!preg_match('/^http/i', $nextUrl)) {
                            $parsed = parse_url($currentUrl);
                            $base = $parsed['scheme'] . '://' . $parsed['host'];
                            if (strpos($nextUrl, '/') !== 0) {
                                $path = dirname($parsed['path'] ?? '/');
                                $nextUrl = $base . ($path === '/' ? '' : $path) . '/' . $nextUrl;
                            } else {
                                $nextUrl = $base . $nextUrl;
                            }
                        }
                        $currentUrl = $nextUrl;
                    } else {
                        break;
                    }
                } else {
                    break;
                }
            }
            curl_close($ch);

            return response()->json([
                'success' => true,
                'chain' => $chain,
                'final_destination' => $currentUrl
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to check redirects: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Silently log the conversion to database.
     */
    protected function logConversion($slug, $originalName, $originalSize, $processedSize, $time, $request)
    {
        try {
            ConversionLog::create([
                'tool_slug' => $slug,
                'original_filename' => $originalName,
                'original_size' => $originalSize,
                'processed_size' => $processedSize,
                'status' => 'completed',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'processing_time_ms' => $time,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Failed to log conversion: ' . $e->getMessage());
        }
    }
}
