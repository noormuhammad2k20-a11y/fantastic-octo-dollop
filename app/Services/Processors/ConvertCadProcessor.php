<?php

namespace App\Services\Processors;

class ConvertCadProcessor extends BaseProcessor
{
    public function process(string|array $inputPath, string $slug, array $options = []): array
    {
        return ['success' => true, 'message' => 'Auto-generated stub for ConvertCadProcessor'];
    }
}
