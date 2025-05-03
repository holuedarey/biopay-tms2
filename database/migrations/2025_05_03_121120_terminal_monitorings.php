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
        Schema::create('terminal_monitorings', function (Blueprint $table) {
            $table->id();
            $table->string('serial'); // Ensure serial matches `terminals` table
            $table->foreign('serial')->references('serial')->on('terminals')->onDelete('cascade');

            $table->string('appVersion')->nullable();
            $table->boolean('backCameraAvailable')->default(false);
            $table->integer('batteryLevel')->nullable();
            $table->boolean('bluetoothAvailable')->default(false);
            $table->boolean('chipReaderAvailable')->default(false);
            $table->boolean('contactlessReaderAvailable')->default(false);
            $table->string('deviceIp')->nullable();
            $table->string('deviceState')->nullable();
            $table->boolean('fingerPrintReaderAvailable')->default(false);
            $table->boolean('frontCameraAvailable')->default(false);
            $table->boolean('magstripeReaderAvailable')->default(false);
            $table->boolean('networkState')->default(false);
            $table->string('networkType')->nullable();
            $table->string('packageId')->nullable();
            $table->boolean('printerState')->default(false);
            $table->decimal('requestLat', 10, 7)->default(0.0);
            $table->decimal('requestLong', 10, 7)->default(0.0);
            $table->integer('signalStrength')->nullable();
            $table->string('storageState')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terminal_monitorings');
    }
};
