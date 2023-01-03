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
            $table->string('email',50)->nullable();
            $table->string('ic_no',14)->nullable();
            $table->string('address',150)->nullable();
            $table->string('phone_no',12)->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')->references('id')->on('ref_position');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('ref_department');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('staff');
            $table->string('is_supervisor',2)->nullable();
            $table->string('status_id',2)->nullable();
            $table->unsignedBigInteger('leave_entitlement_id')->nullable();
            $table->foreign('leave_entitlement_id')->references('id')->on('staff_leave_entitlement');
            $table->unsignedBigInteger('leave_balance_id')->nullable();
            $table->foreign('leave_balance_id')->references('id')->on('staff_leave_balance');
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