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
        Schema::create('app_updates', function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->integer('version_code');
            $table->enum('old_device', ['HORIZONPAY_K11', 'MOBILE', 'ASINO_A75']);
            $table->enum('device', ['HORIZONPAY_K11', 'ASINO_A75', 'MOBILE'])->default('HORIZONPAY_K11');
            $table->string('path')->unique();
            $table->text('info');
            $table->integer('download_count')->default(0);
            $table->timestamps();

            $table->unique(['version', 'device']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_updates');
    }
};
