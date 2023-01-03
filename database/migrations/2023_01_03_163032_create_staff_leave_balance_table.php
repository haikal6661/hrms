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
        Schema::create('staff_leave_balance', function (Blueprint $table) {
            $table->id();
            $table->float('annual_leave')->nullable();
            $table->float('sick_leave')->nullable();
            $table->float('paternity_leave')->nullable();
            $table->float('maternity_leave')->nullable();
            $table->float('marriage_leave')->nullable();
            $table->float('compassionate_leave')->nullable();
            $table->float('unpaid_leave')->nullable();
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
        Schema::dropIfExists('staff_leave_balances');
    }
};
