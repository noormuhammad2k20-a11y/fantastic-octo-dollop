<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scan_histories', function (Blueprint $table) {
            $table->id();
            $table->string('scan_type')->default('full'); // full, quick, category, broken_only
            $table->string('triggered_by')->default('cli'); // cli, dashboard, scheduler
            $table->integer('total_scanned')->default(0);
            $table->integer('healthy')->default(0);
            $table->integer('broken')->default(0);
            $table->integer('slow')->default(0);
            $table->integer('ui_only')->default(0);
            $table->integer('static_count')->default(0);
            $table->integer('duration_seconds')->default(0);
            $table->string('category_filter')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scan_histories');
    }
};
