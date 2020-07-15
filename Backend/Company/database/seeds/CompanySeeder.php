<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('company')->insert([
		    	'id' => $faker->lexify('???'), //$company_id,
		        'name' => $faker->company,
		        'code' => $faker->lexify('???'),
		        'contact' => $faker->e164PhoneNumber,
		        'address' => $faker->address,
		        'isArchived' => 0,
		        'created_by' => $faker->lexify('???'),//$created_by,
	        ]);
		}
    }
}
