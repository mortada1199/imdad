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
            $table->nullableMorphs('accountable');
            $table->double('balance')->default(0);
            $table->double('pending')->default(0);
            $table->string('card_number')->nullable();
            $table->string('password')->nullable();
            $table->set('type', ['sender', 'receiver']);
            $table->set('status', ['active', 'disabled'])->default('active');
            $table->foreignId('profile_id');
            $table->timestamps();
            $table->softDeletes();
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
