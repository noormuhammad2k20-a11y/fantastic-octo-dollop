<?php

namespace App\Services\Processors;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class BaseProcessor
{
    /**
     * Process the file and return the result.
     */
    abstract public function process(string|array $inputPath, string $slug, array $options): array;

    /**
     * Get the full path for a file in the public storage disk.
     */
    protected function getFullPath(string $path): string
    {
        return Storage::disk('public')->path($path);
    }

    /**
     * Generate a unique processed filename.
     */
    protected function generateProcessedFilename(string $originalName, string $extension = null): string
    {
        if (!$extension) {
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        }

        $cleanName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        return 'processed_' . Str::random(10) . '_' . $cleanName . '.' . $extension;
    }

    /**
     * Run a shell command securely.
     */
    protected function runCommand(string $command): bool
    {
        exec($command . ' 2>&1', $output, $returnCode);

        if ($returnCode !== 0) {
            \Log::error("Command failed: $command", ['output' => $output]);
            return false;
        }

        return true;
    }
}
