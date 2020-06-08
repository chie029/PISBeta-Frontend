<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Compensation extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'compensationanddeduction';
}
