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
        Schema::create('seo_health_logs', function (Blueprint $table) {
            $table->id();
            $table->string('tool_slug')->unique();
            $table->string('url')->nullable();
            $table->integer('seo_score')->default(0);
            $table->string('index_status')->default('indexed'); // indexed, noindex
            $table->integer('page_speed_score')->default(0);
            $table->float('fcp')->default(0);
            $table->float('lcp')->default(0);
            $table->float('tbt')->default(0);
            $table->json('issues')->nullable();
            $table->json('meta_data')->nullable(); // title, description, canonical, og_tags
            $table->timestamp('checked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_health_logs');
    }
};
