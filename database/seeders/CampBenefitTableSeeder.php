<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampBenefit;
class CampBenefitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campBenefits = [
        [
            'camp_id' => 1,
            'name' => 'Pro TechStack Kit'
        ],
        $campBenefits = [
            'camp_id' => 1,
            'name' => 'iMac Pro 2021 & Display'
        ],
        $campBenefits = [
            'camp_id' => 1,
            'name' => '1-1 Mentoring Program'
        ],
        $campBenefits = [
            'camp_id' => 1,
            'name' => 'Final Project Certificate'
        ],
        $campBenefits = [
            'camp_id' => 1,
            'name' => 'Offline Course Videos'
        ],
        $campBenefits = [
            'camp_id' => 1,
            'name' => 'Future Job Opportinity'
        ],
        $campBenefits = [
            'camp_id' => 1,
            'name' => 'Premium Design Kit'
        ],
        $campBenefits = [
            'camp_id' => 1,
            'name' => 'Website Builder'
        ],
        $campBenefits = [
            'camp_id' => 2,
            'name' => '1-1 Mentoring Builder'
        ],
        $campBenefits = [
            'camp_id' => 2,
            'name' => 'Final Project Certificate'
        ],
        $campBenefits = [
            'camp_id' => 2,
            'name' => 'Offline Course Videos'
        ],
    ];

    CampBenefit::insert($campBenefits);
    }
}
