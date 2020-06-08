<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EducationalBackground extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empoyee_education', function (Blueprint $table) {
            $table->string('employee_id')->unique();
            $table->object('educational_background');
            // $table->string('institute_location');
            // $table->string('graduation_month');
            // $table->string('graduation_year');
            // $table->string('qualification');
            // $table->string('major');
            // $table->string('additional_information');
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
        Schema::dropIfExists('empoyee_education');
    }
}
