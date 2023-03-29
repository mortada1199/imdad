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
        Schema::create('driver_warehouse', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->references("id")->on("drivers")->cascadeOnDelete();
            $table->foreignId('warehouse_id')->references("id")->on("warehouses")->cascadeOnDelete();
            $table->foreignId('profile_id')->nullable(true)->references("id")->on("profiles")->cascadeOnDelete();
            $table->enum('status', ['active', 'inActive'])->default('active');
            $table->unique(['driver_id','warehouse_id']);
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
        //
    }
};
