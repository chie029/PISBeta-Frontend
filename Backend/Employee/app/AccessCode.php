<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AccessCode extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'access_control_code';
}
