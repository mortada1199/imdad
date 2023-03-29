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
        Schema::create('product_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->references("id")->on("profiles")->cascadeOnDelete();
            $table->foreignId('product_id')->references("id")->on("products")->cascadeOnDelete();
            $table->boolean('status')->default(true);
            $table->unique(['profile_id','product_id']);
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
        Schema::dropIfExists('product_profile');
    }
};
