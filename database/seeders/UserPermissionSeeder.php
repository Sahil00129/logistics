<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sidebar option name
        $input = [
            [
                'name' => 'users',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => 'dashboard',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => 'managers',
                'status' => 1,
                'created_at' => time()
            ],     
            

        ];
        foreach ($input as $val) {
            Permission::firstOrCreate($val);
        }
    }
}
