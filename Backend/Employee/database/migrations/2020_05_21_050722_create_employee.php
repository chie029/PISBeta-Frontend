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
            $table->string('employee_code');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix_name');
            $table->string('email');
            $table->string('personal_email');
            $table->string('mobile_no');
            $table->string('gender');
            $table->string('height');
            $table->string('weight');
            $table->string('religion');
            $table->string('marital_status');
            $table->string('citizenship');
            $table->string('birth_date');
            $table->string('birth_place');
            $table->string('present_address');
            $table->string('province_address');
            $table->string('image');
            $table->string('has_account');
            $table->object('role');
            $table->string('password');
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
