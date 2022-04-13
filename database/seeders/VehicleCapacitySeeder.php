<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleCapacity;

class VehicleCapacitySeeder extends Seeder
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
                'name' => '1MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '2MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '3MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '4MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '5MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '6MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '7MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '8MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '9MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '10MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '11MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '12MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '13MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '14MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '15MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '16MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '17MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '18MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '19MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '20MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '21MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '22MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '23MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '24MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '25MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '26MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '27MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '28MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '29MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '30MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '31MT',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => '32MT',
                'status' => 1,
                'created_at' => time()
            ],
            
        ];
        foreach ($input as $val) {
            VehicleCapacity::firstOrCreate($val);
        }
    }
}
