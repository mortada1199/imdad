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
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("logo_path",90)->unique()->nullable(true);
            $table->string("cr_path",90)->unique()->nullable(true);
            $table->string("vat_path",90)->unique()->nullable(true);
            $table->string("company_id",25)->nullable(true);
            $table->tinyInteger("company_type")->default(0)->comment("0=emdad,1=buyer,2=supplier");
            $table->string("company_vat_id",25)->nullable(true);
            $table->string("company_cr_id",25)->unique()->nullable(true);
            $table->string("contact_name",100)->nullable(true);
            $table->string("contact_phone",15)->nullable(false);
            $table->boolean("is_validated")->default(false);
            $table->string("contact_email",100)->nullable(false);
            $table->date("cr_expire_data")->nullable(true);
            $table->json("subscription_details")->nullable(true);
            $table->foreignId('subs_id')->nullable(true)->references("id")->on("subscription_packages")->restrictOnDelete();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_info');
    }
};
