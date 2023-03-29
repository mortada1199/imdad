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
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id');
            $table->foreignId('package_id');
            $table->foreignId('user_id');
            $table->foreignId('coupon_id')->nullable();
            $table->timestamp('expire_date')->nullable();
            $table->float('sub_total')->default(0);
            $table->float('tax_amount')->default(0);
            $table->float('total')->default(0);
            $table->float('discount')->default(0);
            $table->unsignedBigInteger('tx_id')->nullable();
            $table->enum('status',['Pending', 'Paid', 'Cancel'])->default('Pending');
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
        Schema::dropIfExists('subscription_payments');
    }
};
