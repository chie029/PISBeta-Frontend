<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Company extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'company';


    protected $fillable = [
        'company_id', 'company_name','company_code', 'company_contact','company_address','company_archived'
    ];
}
