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
        Schema::create('profile_category_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->references("id")->on("profiles")->cascadeOnDelete();
            $table->foreignId('user_id')->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId('category_id')->references("id")->on("categories")->cascadeOnDelete();
            $table->enum('status', ['active', 'inActive'])->default('active');
            $table->unique(['profile_id','category_id']);
            $table->softDeletes();
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
        Schema::dropIfExists('profile_category_pivots');
    }
};
