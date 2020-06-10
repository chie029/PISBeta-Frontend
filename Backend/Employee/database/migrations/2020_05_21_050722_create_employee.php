<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->string('employee_id')->unique();
            $table->object('employee_basic_information');
            $table->object('employee_educational_background');
            $table->object('employee_additional_information');
            $table->object('employee_position');
            $table->object('employee_payroll_details');
            $table->object('employee_user_information');
            $table->object('employee_compensation');
            $table->rememberToken();
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
        Schema::dropIfExists('employee');
    }
}
