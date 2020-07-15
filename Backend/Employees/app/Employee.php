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


	// Sorting
	public function scopeSorting ($query, $sort_in, $sort_by)
	{
		$sort_in = trim ($sort_in);
		$sort_by = trim ($sort_by);

		$sort_in_only = ['name', 'code', 'position', 'department', 'company'];
		if (!in_array($sort_in, $sort_in_only)) return $query;

		$r = $query->orderBy($sort_in, $sort_by);
		return $r;
	}

	// Search
	public function scopeSearch ($query, $string)
	{
		$string = trim ($string);
		$r = $query->where('id','like','%'.$string.'%')
		->orWhere('email', 'like', '%'.$string.'%')
		->orWhere('basic_information.first_name', 'like', '%'.$string.'%')
		->orWhere('basic_information.middle_name', 'like', '%'.$string.'%')
		->orWhere('basic_information.last_name', 'like', '%'.$string.'%')
		->orWhere('position.position', 'like', '%'.$string.'%')
		->orWhere('position.department.department_name', 'like', '%'.$string.'%')
		->orWhere('position.company.company_name', 'like', '%'.$string.'%');
		return $r;
	}
}
