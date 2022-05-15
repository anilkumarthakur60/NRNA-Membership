<?php

namespace Database\Seeders;

use App\Models\Membertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $membertypes = [
            [
                'name' => 'General Membershipt',
                'price' => 1
            ],
            [
                'name' => 'Life Time Membershipt',
                'price' => 2
            ]
        ];


        foreach ($membertypes as $member) {
            Membertype::create($member);
        }
        //
    }
}
