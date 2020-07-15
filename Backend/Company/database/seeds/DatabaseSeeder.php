<?php

use App\Company;
use App\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$created_by = Employee::first();
        $company_id = Company::select('id')->orderBy('id', 'desc')->first();

        if ($company_id == null) {
            $new_id = "COMP_0001";
        } else {
            $count = explode('_', $company_id['id']);
            $add_count = $count[1] + 1;
            if ($add_count < 10) { $new_id = "COMP_" . "000" . $add_count; } else { $new_id = "COMP_" . "00" . $add_count; }
        };

        Company::insert([
        	'id' => $company_id,
            'name' => Str::random(10),
            'code' => Str::random(10),
            'contact' => Str::random(10),
            'address' => Str::random(10),
            'isArchived' => 0,
            'created_by' => $created_by,
        ]);
    }
}
