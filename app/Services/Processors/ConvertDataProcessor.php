<?php

namespace App\Services\Processors;

class ConvertDataProcessor extends BaseProcessor
{
    public function process(string|array $inputPath, string $slug, array $options = []): array
    {
        return ['success' => true, 'message' => 'Auto-generated stub for ConvertDataProcessor'];
    }
}
