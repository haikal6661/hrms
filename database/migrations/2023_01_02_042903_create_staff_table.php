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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('fullname',50)->nullable();
            $table->string('image',50)->nullable();
            $table->string('image_path',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('ic_no',14)->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('ref_gender');
            $table->string('address',150)->nullable();
            $table->string('phone_no',12)->nullable();
            $table->date('date_of_employment')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')->references('id')->on('ref_position');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('ref_department');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('staff');
            $table->string('is_supervisor',2)->nullable();
            $table->boolean('is_active',2)->nullable();
            $table->foreign('status_id')->references('id')->on('ref_status');
            $table->unsignedBigInteger('status_id')->nullable();
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
        Schema::dropIfExists('staff');
    }
};
