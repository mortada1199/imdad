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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->integer('value');
            $table->boolean('is_percentage')->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('allowed')->comment('allowed coupon use');
            $table->integer('used')->default(0)->comment('count of coupon use');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('profile_id')->nullable();
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
        Schema::dropIfExists('coupons');
    }
};
