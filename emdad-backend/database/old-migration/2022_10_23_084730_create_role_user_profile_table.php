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
        Schema::create('role_user_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->nullable(true)->references("id")->on("roles")->cascadeOnDelete();
            $table->foreignId('user_id')->nullable(true)->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId('profile_id')->nullable(true)->references("id")->on("profiles")->cascadeOnDelete();
            $table->unique(["role_id","user_id","profile_id","deleted_at"])->name("user_role_profile_deletedat");
            $table->softDeletes();
            $table->enum("status",['active','inActive'])->default('active');
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
        Schema::dropIfExists('role_user_profile');
    }
};
