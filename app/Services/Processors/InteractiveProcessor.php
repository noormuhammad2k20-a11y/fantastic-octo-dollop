<?php

namespace App\Services\Processors;

class InteractiveProcessor extends BaseProcessor
{
    public function process(string|array $inputPath, string $slug, array $options = []): array
    {
        // General processor — implement tool logic here
        return [
            'success' => true,
            'message' => 'InteractiveProcessor processed successfully',
        ];
    }
}
