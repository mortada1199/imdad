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
        Schema::create('related_companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("cr_name",200);
            $table->string("identity_type",10);
            $table->string("business_type",20);
            $table->string("relation",20);
            $table->string("identity",20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_companies');
    }
};
