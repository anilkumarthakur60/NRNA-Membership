<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Pending', 'Unverified', 'Payment Issue', 'Voter', 'Associate Member', 'Rejected'
        ];


        foreach ($data as $usertype) {
            UserType::create(['name' => $usertype]);
        }

        //
    }
}
