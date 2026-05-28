<?php

namespace App\Services\Processors;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Batch3Processor extends BaseProcessor
{
    /**
     * Process tool logic based on the config/tools.php assigned 'processor'
     */
    public function process(string|array $inputPath, string $slug, array $options): array
    {
        $path = is_array($inputPath) ? ($inputPath[0] ?? null) : $inputPath;
        Storage::disk('public')->makeDirectory('uploads/processed');

        // Cluster 2: Font / CAD Cluster
        if ($slug === 'ttf-to-svg' || $slug === 'dwg-to-svg') {
             return $this->handleSpecificLogic($path, $slug, $options);
        }

        // Cluster 4: Financial Converters
        if (in_array($slug, ['csv-to-ofx', 'csv-to-qif', 'vcf-to-csv', 'csv-to-vcard', 'ofx-to-qfx', 'ofx-to-excel', 'ofx-to-qbo', 'excel-to-ofx'])) {
            return $this->handleFileConversion($path, $slug, $options);
        }

        // Cluster 6: Web / SEO Tools
        if (in_array($slug, ['sitemap-extractor', 'robots-txt-extractor', 'url-shortener'])) {
            return $this->handleSpecificLogic($path, $slug, $options);
        }

        return ['success' => false, 'message' => 'Processor routing not matched for ' . $slug];
    }

    private function handleFileConversion($path, $slug, $options)
    {
        $to = $options['to'] ?? 'ofx';
        if (!$path || !file_exists(Storage::disk('public')->path($path))) return ['success' => false, 'message' => 'Input missing.'];

        $inputFull = $this->getFullPath($path);
        
        try {
            $data = $this->parseInputFile($inputFull); // Handles CSV, Excel, VCF, OFX
            
            $filename = $this->generateProcessedFilename(basename($inputFull), $to);
            $outputRel = 'uploads/processed/' . $filename;
            $outputFull = $this->getFullPath($outputRel);
            
            $content = match($to) {
                'ofx', 'qfx', 'qbo' => $this->formatAsOfx($data),
                'qif' => $this->formatAsQif($data),
                'vcard' => $this->formatAsVcard($data),
                'csv' => $this->formatAsCsv($data),
                'excel' => $this->formatAsExcel($data, $outputFull),
                default => json_encode($data)
            };
            
            if ($to !== 'excel') {
                file_put_contents($outputFull, $content);
            }

            return $this->result($outputRel, $filename);
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Data conversion error: ' . $e->getMessage()];
        }
    }

    private function handleSpecificLogic($path, $slug, $options)
    {
        if ($slug === 'url-shortener') {
            $url = request('url');
            if (!$url) return ['success' => false, 'message' => 'URL required.'];
            $short = substr(md5($url . time()), 0, 6);
            $linksPath = storage_path('app/short_links.json');
            $links = file_exists($linksPath) ? json_decode(file_get_contents($linksPath), true) : [];
            $links[$short] = $url;
            file_put_contents($linksPath, json_encode($links));
            $shortUrl = url("/s/$short");
            return ['success' => true, 'message' => 'Shortened successfully!', 'short_url' => $shortUrl, 'download_url' => null];
        }

        if ($slug === 'sitemap-extractor' || $slug === 'robots-txt-extractor') {
            $url = request('url');
            if (!$url) return ['success' => false, 'message' => 'Link required.'];
            $content = @file_get_contents($url);
            if (!$content) return ['success' => false, 'message' => 'Failed to fetch content.'];
            
            $filename = $slug . '_' . time() . '.txt';
            $outputRel = 'uploads/processed/' . $filename;
            file_put_contents($this->getFullPath($outputRel), $content);
            return $this->result($outputRel, $filename);
        }

        return ['success' => false, 'message' => 'No specific logic for ' . $slug];
    }

    // Helper: Result builder
    private function result($rel, $file) {
        $full = $this->getFullPath($rel);
        return [
            'success' => true,
            'processed_path' => $rel,
            'processed_size' => file_exists($full) ? filesize($full) : 0,
            'processed_filename' => $file,
            'download_url' => asset('storage/' . $rel)
        ];
    }

    // Financial Formatting Helpers
    private function parseInputFile($path) {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext === 'csv' || $ext === 'txt') {
            return array_map('str_getcsv', file($path));
        }
        if (in_array($ext, ['xlsx', 'xls', 'ods'])) {
            $spreadsheet = IOFactory::load($path);
            return $spreadsheet->getActiveSheet()->toArray();
        }
        return [];
    }

    private function formatAsOfx($data) {
        $ofx = "OFXHEADER:100\nDATA:OFXSGML\nVERSION:102\nSECURITY:NONE\nENCODING:USASCII\nCHARSET:1252\n<OFX>\n<BANKMSGSRSV1>\n<STMTTRNRS>\n<STMTRS>\n<CURDEF>USD</CURDEF>\n<BANKTRANLIST>\n";
        foreach($data as $row) {
             if (count($row) < 3) continue;
             $ofx .= "<STMTTRN><TRNTYPE>OTHER</TRNTYPE><DTPOSTED>" . date('Ymd') . "</DTPOSTED><TRNAMT>" . ($row[1] ?? 0) . "</TRNAMT><NAME>" . htmlspecialchars($row[0] ?? 'Tx') . "</NAME></STMTTRN>\n";
        }
        $ofx .= "</BANKTRANLIST>\n</STMTRS>\n</STMTTRNRS>\n</BANKMSGSRSV1>\n</OFX>";
        return $ofx;
    }

    private function formatAsQif($data) {
        $qif = "!Type:Bank\n";
        foreach($data as $row) {
            if (count($row) < 2) continue;
            $qif .= "D" . date('m/d/Y') . "\nT" . ($row[1] ?? 0) . "\nP" . ($row[0] ?? 'Item') . "\n^\n";
        }
        return $qif;
    }

    private function formatAsVcard($data) {
        $vcf = "";
        foreach($data as $row) {
            $vcf .= "BEGIN:VCARD\nVERSION:3.0\nFN:" . ($row[0] ?? 'User') . "\nTEL:" . ($row[1] ?? '') . "\nEND:VCARD\n";
        }
        return $vcf;
    }

    private function formatAsCsv($data) {
        $out = fopen('php://temp', 'r+');
        foreach($data as $row) fputcsv($out, $row);
        rewind($out);
        return stream_get_contents($out);
    }

    private function formatAsExcel($data, $path) {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet->getActiveSheet()->fromArray($data);
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($path);
        return true;
    }
}
