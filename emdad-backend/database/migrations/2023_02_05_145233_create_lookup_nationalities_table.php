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
        Schema::create('lookup_nationalities', function (Blueprint $table) {
            $table->id();
            $table->string('country_ar');
            $table->string('country_en');
            $table->bigInteger('country_id');
            $table->string('isoAlpha2');
            $table->string('isoAlpha3');
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
        Schema::dropIfExists('lookup_nationalities');
    }
};
