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
        Schema::create('user_warehouse_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId('warehouse_id')->nullable()->references("id")->on("warehouses")->cascadeOnDelete();
            $table->enum("status",['active','inActive'])->default('active');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['user_id','warehouse_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_warehouse_pivots');
    }
};
