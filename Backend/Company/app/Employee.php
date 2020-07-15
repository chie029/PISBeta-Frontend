<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Employee extends Eloquent
{
	protected $connection = 'mongodb2';
	protected $collection = 'employee';

	protected $fillable = [
		'id',
		'email',
		'password',
		'hasAccount',
		'basic_information',
        'educational_background',
        'additional_information',
        'position',
        'payroll_details',
        'compensation',
        'role',
	];
}
