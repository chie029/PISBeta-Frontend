<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Project extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'project';


    protected $fillable = [
        'id', 'name','lead', 'description','created_by','date_start','date_end', 'deleted_by'
    ];
}
