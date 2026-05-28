<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupTempFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:cleanup';
    protected $description = 'Cleanup temporary uploads and processed files older than 1 hour';

    public function handle()
    {
        $directories = ['uploads/temp', 'uploads/processed'];
        $count = 0;
        $expiryTime = now()->subHour();

        foreach ($directories as $directory) {
            if (!Storage::disk('public')->exists($directory)) continue;

            $files = Storage::disk('public')->files($directory);
            foreach ($files as $file) {
                $lastModified = \Carbon\Carbon::createFromTimestamp(Storage::disk('public')->lastModified($file));
                
                if ($lastModified->lt($expiryTime)) {
                    Storage::disk('public')->delete($file);
                    $count++;
                }
            }
        }

        $this->info("Successfully deleted {$count} expired files.");
    }
}
