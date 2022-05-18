<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'nrna',
            'email' => 'nrna@gmail.com',
            'password' => bcrypt('aaaassss'),
            'usertype' => 1,
            'street_address' => 'nrna_address',
            'apartment' => 'nrna_apartment',
            'city' => 'nrna_city',
            'provience' => 'nrna_provience',
            'zip_code' => 'nrna_zipcode',
            'country' => 'nrna_country',
            'status' => 'nrna_status',
            'total' => 'nrna_total',
            'phone' => 'nrna_9815434',
        ]);
        //
    }
}
