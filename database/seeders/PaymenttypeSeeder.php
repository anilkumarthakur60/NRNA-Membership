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
            ['name' => 'couple', 'price' => 1, 'membertype_id' => 1],
            ['name' => 'couple', 'price' => 2, 'membertype_id' => 2],
        ];

        foreach ($data as $payment) {
            Paymenttype::create($payment);
        }
    }
}
