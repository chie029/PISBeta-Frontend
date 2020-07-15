<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Department extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'department';


    protected $fillable = [
        'id', 'company_id','name', 'head','description','status'
    ];
}
