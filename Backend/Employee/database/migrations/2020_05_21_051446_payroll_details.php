<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PayrollDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empoyee_payroll_details', function (Blueprint $table) {
            $table->string('employee_id')->unique();
            $table->string('payroll_group_id');
            $table->string('tax_no');
            $table->string('sss_no');
            $table->string('pagibig_no');
            $table->string('philhealth_no');
            $table->string('employment_type');
            $table->string('employment_status');
            $table->string('date_hired');
            $table->string('contract_start');
            $table->string('contract_end');
            $table->string('basic_salary');
            $table->string('tax_computation');
            $table->string('bank_name');
            $table->string('bank_account_no');
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
        Schema::dropIfExists('empoyee_payroll_details');
    }
}
