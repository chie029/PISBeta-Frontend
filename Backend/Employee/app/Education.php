<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Education extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'empoyee_education';


    protected $fillable = [
        'employee_id', 
        'institute_name',
        'institute_location', 
        'graduation_month',
        'graduation_year',
        'qualification',
        'major',
        'additional_information',
    ];
}
