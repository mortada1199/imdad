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
        Schema::create('payment_txes', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->enum('type',['subscription','wallet']);
            $table->string('provider');
            $table->string('status');
            $table->integer('ref_id');
            $table->string('gateway_tx_id')->nullable();
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
        Schema::dropIfExists('payment_txes');
    }
};
