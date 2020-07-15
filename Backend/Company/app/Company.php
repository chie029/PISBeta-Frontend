<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Company extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'company';

    protected $fillable = [
        'id', 'name','code', 'contact','address','isArchived','created_by','updated_by'
    ];

	// Sorting
	public function scopeSorting ($query, $sort_in, $sort_by)
	{
		$sort_in = trim ($sort_in);
		$sort_by = trim ($sort_by);

		$sort_in_only = ['name', 'code'];
		if (!in_array($sort_in, $sort_in_only)) return $query;

		$r = $query->orderBy($sort_in, $sort_by);
		return $r;
	}

	// Search
	public function scopeSearch ($query, $string)
	{
		$string = trim ($string);
		$r = $query->where('id','like','%'.$string.'%')
		->orWhere('code', 'like', '%'.$string.'%')
		->orWhere('contact', 'like', '%'.$string.'%')
		// ->orWhere('employee_code', 'like', '%'.$string.'%')
		->orWhere('address', 'like', '%'.$string.'%');
		return $r;
	}
}
