<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Project extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'project';


    protected $fillable = [
        'project_id', 'project_name','project_lead', 'project_description','created_by','date_start','date_end', 'deleted_by'
    ];
}
