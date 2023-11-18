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
        Schema::create('staff_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->string('marriage_status',10)->nullable();
            $table->string('spouse_name',50)->nullable();
            $table->string('spouse_phone_no',20)->nullable();
            $table->string('occupation',50)->nullable();
            $table->smallInteger('no_children')->nullable();
            $table->string('emergency_name',50)->nullable();
            $table->string('emergency_phone_no',20)->nullable();
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
        Schema::dropIfExists('staff_details');
    }
};
