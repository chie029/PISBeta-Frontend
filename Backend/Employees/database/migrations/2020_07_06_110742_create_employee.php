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
            $table->string('id')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('hasAccount');
            $table->object('basic_information');
            $table->object('educational_background');
            $table->object('additional_information');
            $table->object('position');
            $table->object('payroll_details');
            $table->object('compensation');
            $table->object('role');
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
