<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Department extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'department';


    protected $fillable = [
        'department_id', 'company_id','department_name', 'department_head','department_description','department_status'
    ];
}
