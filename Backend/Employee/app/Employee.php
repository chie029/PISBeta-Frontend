<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Employee extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'employee';

	protected $fillable = [
		'employee_id',
		'employee_basic_information',
        'employee_educational_background',
        'employee_additional_information',
        'employee_position',
        'employee_payroll_details',
        'employee_user_information',
        'employee_compensation',
	];
}
