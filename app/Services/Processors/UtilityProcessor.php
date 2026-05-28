<?php

namespace App\Services\Processors;

class UtilityProcessor extends BaseProcessor
{
    /**
     * Process utility files (archives).
     */
    public function process(string|array $tempPath, string $slug, array $options): array
    {
        $inputPath = $this->getFullPath($tempPath);
        $originalName = basename($inputPath);

        $extension = $options['format'] ?? pathinfo($originalName, PATHINFO_EXTENSION);
        $processedFilename = $this->generateProcessedFilename($originalName, $extension);
        $outputPath = 'uploads/processed/' . $processedFilename;
        $fullOutputPath = $this->getFullPath($outputPath);

        \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('uploads/processed');



        if ($slug === 'archive-converter') {
            return $this->processArchive($inputPath, $fullOutputPath, $options, $outputPath, $processedFilename);
        }

        if (in_array($slug, ['word-counter', 'remove-duplicates', 'case-converter', 'remove-spaces', 'text-cleaner', 'email-extractor', 'tag-extractor'])) {
            return $this->processText($inputPath, $fullOutputPath, $slug, $options, $outputPath, $processedFilename);
        }

        // Simple copy for generic utility tools unless specific logic is added
        copy($inputPath, $fullOutputPath);

        return [
            'success' => true,
            'processed_path' => $outputPath,
            'processed_size' => filesize($fullOutputPath),
            'processed_filename' => $processedFilename
        ];
    }

    protected function processArchive($input, $output, $options, $relOutput, $filename)
    {
        $targetFormat = $options['format'] ?? 'zip';
        
        // If target is ZIP
        if ($targetFormat === 'zip') {
            $zipBin = __DIR__ . '/../../../Tools/ZipUnzip/zip.exe';
            if (file_exists($zipBin)) {
                $command = sprintf('%s -j %s %s', escapeshellarg($zipBin), escapeshellarg($output), escapeshellarg($input));
                shell_exec($command);
            } else {
                // Fallback to ZipArchive if CLI is missing
                $zip = new \ZipArchive();
                if ($zip->open($output, \ZipArchive::CREATE) === TRUE) {
                    $zip->addFile($input, basename($input));
                    $zip->close();
                } else {
                    return ['success' => false, 'message' => 'Failed to create ZIP archive.'];
                }
            }
        } else {
            // For TAR/GZ, use shell commands if available
            copy($input, $output);
        }

        return [
            'success' => true,
            'processed_path' => $relOutput,
            'processed_size' => filesize($output),
            'processed_filename' => $filename
        ];
    }

    protected function processText($input, $output, $slug, $options, $relOutput, $filename)
    {
        $content = file_get_contents($input);
        $result = $content;

        switch ($slug) {
            case 'word-counter':
                $count = str_word_count($content);
                $result = "Word Count: " . $count . "\nCharacter Count: " . strlen($content) . "\n\nOriginal Text:\n" . $content;
                break;
            case 'remove-duplicates':
                $lines = explode("\n", $content);
                $unique = array_unique(array_map('trim', $lines));
                $result = implode("\n", $unique);
                break;
            case 'case-converter':
                $case = $options['case'] ?? 'upper';
                $result = match($case) {
                    'upper' => strtoupper($content),
                    'lower' => strtolower($content),
                    'title' => ucwords(strtolower($content)),
                    default => $content
                };
                break;
            case 'remove-spaces':
                $result = preg_replace('/\s+/', ' ', trim($content));
                break;
            case 'email-extractor':
                preg_match_all('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/i', $content, $matches);
                $emails = array_unique($matches[0]);
                $result = implode("\n", $emails);
                break;
            case 'tag-extractor':
                // Extract hashtags
                preg_match_all('/#\w+/i', $content, $matches);
                $tags = array_unique($matches[0]);
                $result = "Hashtags Found:\n" . implode("\n", $tags);
                break;
        }

        file_put_contents($output, $result);

        return [
            'success' => true,
            'processed_path' => $relOutput,
            'processed_size' => filesize($output),
            'processed_filename' => $filename
        ];
    }
}
