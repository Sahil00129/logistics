<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeadQuarterAddress;

class HeadQuarterAddressSeeder extends Seeder
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
                'address' => 'Frontier',
                'city' => 'Chandigarh',
                'district' => 'Mohali',
                'postal_code' => '160101',
                'status' => 1,
                'created_at' => time()
            ],

        ];
        foreach ($input as $val) {
            HeadQuarterAddress::firstOrCreate($val);
        }
    }
}
