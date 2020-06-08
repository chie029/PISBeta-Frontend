<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Employee extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'employee';


    protected $fillable = [
        'employee_id', 
        'employee_code',
        'first_name', 
        'middle_name',
        'last_name',
        'suffix_name',
        'email',
        'personal_email',
        'mobile_no',
        'gender',
        'height',
        'weight',
        'religion',
        'marital_status',
        'citizenship',
        'birth_date',
        'birth_place',
        'present_address',
        'province_address',
        'image',
        'has_account',
        'role',
        'password',
    ];
}
