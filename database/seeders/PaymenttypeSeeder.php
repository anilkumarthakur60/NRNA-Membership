<?php

namespace Database\Seeders;

use App\Models\Paymenttype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymenttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ['name' => 'single', 'price' => 5],
            ['name' => 'couple', 'price' => 10],
        ];

        foreach ($data as $payment) {
            Paymenttype::create($payment);
        }
    }
}
