<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Employee;
use Faker\Generator as Faker;



$factory->define(Company::class, function (Faker $faker) {

	// $created_by = Employee::first();
	// $company_id = Company::select('id')->orderBy('id', 'desc')->first();

	// if ($company_id == null) {
	//     $new_id = "COMP_0001";
	// } else {
	//     $count = explode('_', $company_id['id']);
	//     $add_count = $count[1] + 1;
	//     if ($add_count < 10) { $new_id = "COMP_" . "000" . $add_count; } else { $new_id = "COMP_" . "00" . $add_count; }
	// };

    return [
    	'id' => $faker->lexify('???'), //$company_id,
        'name' => $faker->company,
        'code' => $faker->lexify('???'),
        'contact' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'isArchived' => 0,
        'created_by' => $faker->lexify('???'),//$created_by,
    ];
});
