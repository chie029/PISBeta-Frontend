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

	// Sorting
	public function scopeSorting ($query, $sort_in, $sort_by)
	{
		$sort_in = trim ($sort_in);
		$sort_by = trim ($sort_by);

		$sort_in_only = ['company_name', 'company_code'];
		if (!in_array($sort_in, $sort_in_only)) return $query;

		$r = $query->orderBy($sort_in, $sort_by);
		return $r;
	}

	// Search
	public function scopeSearch ($query, $string)
	{
		$string = trim ($string);
		$r = $query->where('company_id','like','%'.$string.'%')
		->orWhere('company_code', 'like', '%'.$string.'%')
		->orWhere('company_contact', 'like', '%'.$string.'%')
		->orWhere('employee_code', 'like', '%'.$string.'%')
		->orWhere('company_address', 'like', '%'.$string.'%');
		return $r;
	}
}
