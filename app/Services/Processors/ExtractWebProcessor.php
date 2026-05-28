<?php

namespace App\Services\Processors;

class ExtractWebProcessor extends BaseProcessor
{
    public function process(string|array $inputPath, string $slug, array $options = []): array
    {
        return ['success' => true, 'message' => 'Auto-generated stub for ExtractWebProcessor'];
    }
}
