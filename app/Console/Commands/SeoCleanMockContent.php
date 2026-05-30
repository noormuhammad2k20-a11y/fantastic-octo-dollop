<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class SeoCleanMockContent extends Command
{
    protected $signature = 'seo:clean-mock-content
        {--dry-run  : Preview what would be deleted without making changes}
        {--skip-backup : Skip creating the backup table (dangerous)}
        {--force : Skip confirmation prompts}';

    protected $description = 'Backup and delete all mock/template content drafts (Priority 1 Emergency Cleanup)';

    private const MOCK_HASH = '6b0a0616767ff0fdc4cae362d4cae5f2';
    private const MOCK_WORD_COUNT = 118;
    private const BACKUP_TABLE = 'content_drafts_mock_backup_may2026';

    public function handle(): int
    {
        $this->info('═══════════════════════════════════════════');
        $this->info('  PRIORITY 1 — Emergency Mock Content Cleanup');
        $this->info('═══════════════════════════════════════════');
        $this->newLine();

        // Step 1: Count mock content
        $mockCount = $this->countMockContent();
        $this->info("Found {$mockCount} mock/template content drafts.");

        if ($mockCount === 0) {
            $this->info('✅ No mock content found. Database is clean.');
            Log::channel('seo')->info('Mock cleanup: No mock content found — database is already clean.');
            return Command::SUCCESS;
        }

        // Show what will be affected
        $this->showMockContentPreview();

        if ($this->option('dry-run')) {
            $this->warn('DRY RUN — No changes made. Remove --dry-run to execute.');
            return Command::SUCCESS;
        }

        // Confirm
        if (!$this->option('force') && !$this->confirm("Delete {$mockCount} mock drafts? (Backup will be created first)")) {
            $this->info('Aborted.');
            return Command::SUCCESS;
        }

        // Step 1A: Backup
        if (!$this->option('skip-backup')) {
            $this->createBackup();
        }

        // Step 1C: Delete mock content
        $deleted = $this->deleteMockContent();

        // Step 1D: Verify
        $this->verifyCleanup();

        // Step 1E: Restore any legitimate approved/published content
        if (!$this->option('skip-backup')) {
            $this->restoreLegitimateContent();
        }

        $this->newLine();
        $this->info("✅ Cleanup complete. Deleted {$deleted} mock drafts.");
        Log::channel('seo')->info("Mock cleanup complete. Deleted {$deleted} mock drafts.");

        return Command::SUCCESS;
    }

    private function countMockContent(): int
    {
        return DB::table('content_drafts')
            ->where(function ($q) {
                $q->where('generation_prompt_hash', self::MOCK_HASH)
                  ->orWhere('draft_content', 'LIKE', '%OPENAI_API_KEY was not found%')
                  ->orWhere('draft_content', 'LIKE', '%mock-generated%')
                  ->orWhere('word_count', self::MOCK_WORD_COUNT);
            })
            ->count();
    }

    private function showMockContentPreview(): void
    {
        $samples = DB::table('content_drafts')
            ->where(function ($q) {
                $q->where('generation_prompt_hash', self::MOCK_HASH)
                  ->orWhere('draft_content', 'LIKE', '%OPENAI_API_KEY was not found%')
                  ->orWhere('draft_content', 'LIKE', '%mock-generated%')
                  ->orWhere('word_count', self::MOCK_WORD_COUNT);
            })
            ->select('id', 'tool_slug', 'word_count', 'status', 'generation_prompt_hash')
            ->limit(10)
            ->get();

        $this->newLine();
        $this->table(
            ['ID', 'Tool Slug', 'Words', 'Status', 'Hash (first 12)'],
            $samples->map(fn($s) => [
                $s->id,
                $s->tool_slug,
                $s->word_count,
                $s->status,
                substr($s->generation_prompt_hash ?? '', 0, 12) . '...',
            ])
        );

        if ($samples->count() === 10) {
            $this->line('  ... and more');
        }
        $this->newLine();
    }

    private function createBackup(): void
    {
        $this->info('Step 1A — Creating backup table...');

        // Drop backup table if it already exists from a previous run
        if (Schema::hasTable(self::BACKUP_TABLE)) {
            $this->warn('Backup table already exists. Dropping and recreating...');
            Schema::dropIfExists(self::BACKUP_TABLE);
        }

        DB::statement(
            'CREATE TABLE ' . self::BACKUP_TABLE . '
             SELECT * FROM content_drafts
             WHERE generation_prompt_hash = ?
                OR draft_content LIKE ?
                OR draft_content LIKE ?
                OR word_count = ?',
            [
                self::MOCK_HASH,
                '%OPENAI_API_KEY was not found%',
                '%mock-generated%',
                self::MOCK_WORD_COUNT,
            ]
        );

        $backupCount = DB::table(self::BACKUP_TABLE)->count();
        $this->info("  ✅ Backup created: {$backupCount} rows in `" . self::BACKUP_TABLE . '`');
        Log::channel('seo')->info("Mock cleanup backup: {$backupCount} rows backed up to " . self::BACKUP_TABLE);
    }

    private function deleteMockContent(): int
    {
        $this->info('Step 1C — Deleting mock content...');

        $deleted = DB::table('content_drafts')
            ->where(function ($q) {
                $q->where('generation_prompt_hash', self::MOCK_HASH)
                  ->orWhere('draft_content', 'LIKE', '%OPENAI_API_KEY was not found%')
                  ->orWhere('draft_content', 'LIKE', '%mock-generated%')
                  ->orWhere('word_count', self::MOCK_WORD_COUNT);
            })
            ->delete();

        $this->info("  ✅ Deleted {$deleted} mock drafts.");
        Log::channel('seo')->info("Mock cleanup: Deleted {$deleted} mock drafts.");

        return $deleted;
    }

    private function verifyCleanup(): void
    {
        $this->info('Step 1D — Verifying cleanup...');

        $remaining = DB::table('content_drafts')
            ->selectRaw('COUNT(*) as total, MIN(word_count) as min_words, MAX(word_count) as max_words')
            ->first();

        $this->table(
            ['Remaining Drafts', 'Min Word Count', 'Max Word Count'],
            [[$remaining->total, $remaining->min_words ?? 'N/A', $remaining->max_words ?? 'N/A']]
        );

        // Check no mock content remains
        $mockRemaining = DB::table('content_drafts')
            ->where('word_count', self::MOCK_WORD_COUNT)
            ->count();

        if ($mockRemaining > 0) {
            $this->warn("  ⚠ {$mockRemaining} drafts with word_count={" . self::MOCK_WORD_COUNT . "} still remain.");
        } else {
            $this->info('  ✅ No mock content remaining.');
        }
    }

    private function restoreLegitimateContent(): void
    {
        if (!Schema::hasTable(self::BACKUP_TABLE)) {
            return;
        }

        $this->info('Step 1E — Checking for legitimate approved/published content to restore...');

        $legitCount = DB::table(self::BACKUP_TABLE)
            ->whereIn('status', ['approved', 'published'])
            ->where('draft_content', 'NOT LIKE', '%OPENAI_API_KEY was not found%')
            ->where('draft_content', 'NOT LIKE', '%mock-generated%')
            ->where('word_count', '!=', self::MOCK_WORD_COUNT)
            ->count();

        if ($legitCount > 0) {
            $this->info("  Found {$legitCount} legitimate approved/published drafts — restoring...");
            DB::statement(
                'INSERT INTO content_drafts
                 SELECT * FROM ' . self::BACKUP_TABLE . '
                 WHERE status IN (\'approved\', \'published\')
                   AND draft_content NOT LIKE \'%OPENAI_API_KEY was not found%\'
                   AND draft_content NOT LIKE \'%mock-generated%\'
                   AND word_count != ?',
                [self::MOCK_WORD_COUNT]
            );
            $this->info("  ✅ Restored {$legitCount} legitimate drafts.");
            Log::channel('seo')->info("Mock cleanup: Restored {$legitCount} legitimate drafts from backup.");
        } else {
            $this->info('  No legitimate content found in backup — nothing to restore.');
        }
    }
}
