<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Compensation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compensation', function (Blueprint $table) {
            $table->string('compensation_id')->unique();
            $table->string('name');
            $table->string('amount');
            $table->string('taxable');
            $table->string('type');
            $table->string('code');
            $table->string('payperiod');
            $table->string('prorated');
            $table->string('deminimis');
            $table->string('prorated_absences');
            $table->string('prorated_late');
            $table->string('prorated_undertime');
            $table->string('sss_computation');
            $table->string('thirteenth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compensation');
    }
}
