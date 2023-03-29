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
        Schema::table('subscription_packages', function (Blueprint $table) {
            //
            $table->dropColumn('subscription_name');
            $table->renameColumn('subscription_details','features');
            $table->string("package_name_ar");
            $table->string("package_name_en");
            $table->decimal("price_1")->default(0);
            $table->decimal("price_2")->default(0);
            $table->boolean("free_first_time")->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            //
        });
    }
};
