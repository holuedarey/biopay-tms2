<?php

use App\Models\Fee;
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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('terminal_groups')->cascadeOnDelete();
            $table->unsignedInteger('service_id');
            $table->enum('type', [Fee::CHARGE, Fee::COMMISSION])->default(Fee::CHARGE);
            $table->float('amount', 12);
            $table->enum('amount_type', [Fee::FIXED, Fee::PERCENT, Fee::CONFIG])->default('FIXED');
            $table->float('cap')->default(0.00);
            $table->text('info')->nullable();
            $table->jsonb('config')->nullable();
            $table->jsonb('structure')->nullable();
            $table->timestamps();

            $table->unique(['group_id', 'service_id', 'type'], 'unique_fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
};
