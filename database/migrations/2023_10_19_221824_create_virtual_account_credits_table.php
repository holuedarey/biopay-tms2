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
        Schema::create('virtual_account_credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('virtual_account_id');
            $table->float('amount', 12)->default(0);
            $table->string('reference')->nullable();
            $table->string('provider');
            $table->text('info')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('paid_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('virtual_account_credits');
    }
};
