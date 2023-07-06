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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_type');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('member_id')->unsigned();
            $table->bigInteger('stock_id')->unsigned();
            $table->date('transaction_date');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('status');
            $table->string('order_notes')->nullable();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('stock_id')->references('id')->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
