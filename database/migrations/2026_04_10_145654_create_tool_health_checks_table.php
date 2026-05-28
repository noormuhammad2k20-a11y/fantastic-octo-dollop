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
        Schema::create('tool_health_checks', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->id();
            $table->string('tool_slug')->unique();
            $table->string('status')->default('ok'); // ok, broken, static, slow, ui_only
            $table->integer('response_time_ms')->nullable();
            $table->text('error_message')->nullable();
            $table->string('issue_type')->nullable(); // js_error, empty_output, slow_response, api_error
            $table->string('screenshot_path')->nullable();
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_health_checks');
    }
};
