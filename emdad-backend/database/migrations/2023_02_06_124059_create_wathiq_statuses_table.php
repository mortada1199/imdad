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
        Schema::create('wathiq_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cr_number');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('status');
            $table->json('cancellation');
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
        Schema::dropIfExists('wathiq_statuses');
    }
};
