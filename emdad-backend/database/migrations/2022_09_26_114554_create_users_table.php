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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('full_name');
            $table->string('last_name');
            $table->nullableMorphs('userable');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('identity_number');
            $table->enum('identity_type', ['nid', 'Iqama'])->default('nid');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('expiry_date')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->string('mobile')->unique()->nullable(false);
            $table->boolean("is_super_admin")->default(false);
            $table->boolean("is_verified")->default(false);
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
        Schema::dropIfExists('users');
    }
};
