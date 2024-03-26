<?php

use App\Enums\Action;
use App\Enums\Status;
use App\Models\WalletTransaction;
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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // the product is the service for which the transaction impacts the wallet
            $table->unsignedBigInteger('wallet_id');
            $table->string('reference');
            $table->float('amount', 12);
            $table->float('prev_balance', 12);
            $table->float('new_balance', 12);
            $table->enum('status', [Status::SUCCESSFUL->value, Status::FAILED->value]);
            $table->enum('action', Action::values());
            $table->enum('type', WalletTransaction::TYPES)->default(WalletTransaction::TYPES[0]);
            $table->longText('info')->nullable();
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
        Schema::dropIfExists('wallet_transactions');
    }
};
