<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'type' => '1T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '2T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '3T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '4T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '5T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '6T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '7T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '8T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '9T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '10T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '11T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '12T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '13T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '14T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '15T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '16T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '17T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '18T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '19T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '20T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '21T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '22T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '23T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '24T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '25T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '26T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '27T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '28T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '29T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '30T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '31T',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'type' => '32T',
                'status' => 1,
                'created_at' => time()
            ],
            
        ];
        foreach ($input as $val) {
            VehicleType::firstOrCreate($val);
        }
    }
}
