<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Employee extends Eloquent
{
    
	protected $connection = 'mongodb';
	protected $collection = 'employee';

	protected $fillable = [
		'id',
		'email',
		'basic_information',
        'educational_background',
        'additional_information',
        'position',
        'payroll_details',
        'user_information',
        'compensation',
	];
}
