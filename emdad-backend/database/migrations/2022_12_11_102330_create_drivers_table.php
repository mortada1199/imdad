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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('manageable');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('age');
            $table->string('phone');
            $table->enum("status",['active','inActive'])->default('active');
            $table->string('nationality');
            $table->foreignId('user_id')->nullable()->references("id")->on("users")->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
            $table->unique('name_ar','profile_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
};
