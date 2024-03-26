<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uwid');
            $table->foreignId('user_id')->constrained();
            $table->string('account_number', 10);
            $table->float('balance', 12)->default(0);
            $table->float('income', 12)->default(0);
            $table->enum('status', ['ACTIVE', 'SUSPENDED'])->default('ACTIVE');
            $table->boolean('disable_debit')->default(false);
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
};
