<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Deduction extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'deduction';
}
