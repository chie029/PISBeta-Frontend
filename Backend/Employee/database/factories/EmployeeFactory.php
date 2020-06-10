<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
    	'employee_id' => $faker->numberBetween(11111111, 99999999),
        'employee_basic_information' => [
			'first_name' => $faker->firstName($gender = ''|'male'|'female'),
			'middle_name' => $faker->lastName,
			'last_name' => $faker->lastName,
			'email' => $faker->unique()->safeEmail,
			'personal_email' => $faker->unique()->safeEmail,
			'mobile_no' => $faker->e164PhoneNumber,
		],
        'employee_educational_background' => [
			[
				'institute_name' => $faker->address, 
				'institute_location' => $faker->address,
				'graduation_month' => $faker->monthName($max = 'now'),
				'graduation_year' => $faker->year($max = 'now'),
				'qualification' => $faker->word,
				'major' => $faker->word,
				'additional_information' => $faker->sentence($nbWords = 6, $variableNbWords = true),
			],
			[
				'institute_name' => $faker->address, 
				'institute_location' => $faker->address,
				'graduation_month' => $faker->monthName($max = 'now'),
				'graduation_year' => $faker->year($max = 'now'),
				'qualification' => $faker->word,
				'major' => $faker->word,
				'additional_information' => $faker->randomHtml,
			],
			[
				'institute_name' => $faker->address, 
				'institute_location' => $faker->address,
				'graduation_month' => $faker->monthName($max = 'now'),
				'graduation_year' => $faker->year($max = 'now'),
				'qualification' => $faker->word,
				'major' => $faker->word,
				'additional_information' => $faker->sentence($nbWords = 6, $variableNbWords = true),
			],
		],
        'employee_additional_information' => [
			'gender' => $faker->word,
			'weight' => $faker->numerify('### kg'),
			'height' => $faker->numerify('### cm'),
			'religion' => $faker->randomLetter,
			'marital_status' => $faker->word,
			'citizenship' => $faker->word,
			'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
			'birth_place' => $faker->address,
			'present_address' => $faker->address,
			'province_address' => $faker->state,
		],
        'employee_position' => [
			'company' => [
				'company_name' => $faker->company,
				'company_code' => $faker->lexify('???'),
				'company_contact' => $faker->e164PhoneNumber,
				'company_address' => $faker->address,
			],
			'department' => [
				'department_name' => $faker->bs,
				'department_head' => $faker->name($gender = ''|'male'|'female'),
				'department_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
			],
			'supervisor' => [
				'first_name' => $faker->firstName,
				'middle_name' => $faker->lastName,
				'last_name' => $faker->lastName,
				'email' => $faker->email,
			],
			'position_name' => $faker->jobTitle,
			'project' => [
				[
					'project_name' => $faker->catchPhrase,
					'project_lead' => $faker->name($gender = ''|'male'|'female'),
					'project_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
					'created_by' => $faker->name($gender = ''|'male'|'female'),
					'date_start' => $faker->date($format = 'Y-m-d', $max = 'now'),
					'date_end' => $faker->date($format = 'Y-m-d', $max = 'now'),
				],
				[
					'project_name' => $faker->catchPhrase,
					'project_lead' => $faker->name($gender = ''|'male'|'female'),
					'project_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
					'created_by' => $faker->name($gender = ''|'male'|'female'),
					'date_start' => $faker->date($format = 'Y-m-d', $max = 'now'),
					'date_end' => $faker->date($format = 'Y-m-d', $max = 'now'),
				],
				[
					'project_name' => $faker->catchPhrase,
					'project_lead' => $faker->name($gender = ''|'male'|'female'),
					'project_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
					'created_by' => $faker->name($gender = ''|'male'|'female'),
					'date_start' => $faker->date($format = 'Y-m-d', $max = 'now'),
					'date_end' => $faker->date($format = 'Y-m-d', $max = 'now'),
				],
			],
		],
        'employee_payroll_details' => [
			'tax_id' => $faker->isbn13,
			'sss_id' => $faker->isbn13,
			'pagibig_id' => $faker->isbn13,
			'philhealth_id' => $faker->isbn13,
			'employment_type' => $faker->word,
			'employment_status' => $faker->word,
			'date_hired' => $faker->date($format = 'Y-m-d', $max = 'now'),
			'contract_start' => $faker->date($format = 'Y-m-d', $max = 'now'),
			'contract_end' => $faker->date($format = 'Y-m-d', $max = 'now'),
			'basic_salary' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
			'wage_type' => $faker->word,
			'payout_type' => $faker->word,
			'tax_computation' => $faker->word,
			'bank_name' => $faker->creditCardType,
			'bank_account' => $faker->creditCardNumber,
		],
    ];
});
