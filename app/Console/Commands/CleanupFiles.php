<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanupFiles extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'tools:cleanup';

    /**
     * The console command description.
     */
    protected $description = 'Clean up old temporary upload and processed files (older than 24 hours)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting file cleanup...');

        $directories = ['uploads/temp', 'uploads/processed'];
        $expiryTime = Carbon::now()->subHours(24);
        $count = 0;

        foreach ($directories as $dir) {
            $files = Storage::disk('public')->files($dir);

            foreach ($files as $file) {
                $lastModified = Carbon::createFromTimestamp(Storage::disk('public')->lastModified($file));

                if ($lastModified->lt($expiryTime)) {
                    Storage::disk('public')->delete($file);
                    $count++;
                }
            }
        }

        $this->info("Cleanup completed! Deleted {$count} old files.");
    }
}
