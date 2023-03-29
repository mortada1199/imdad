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
        Schema::create('profile_department_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->nullable()->restrictOnDelete();
            $table->foreignId('department_id')->nullable()->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->restrictOnDelete();
            $table->unique(["department_id","user_id","profile_id"])->name("profile_department_user");;
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
        Schema::dropIfExists('profile_department_user');
    }
};
