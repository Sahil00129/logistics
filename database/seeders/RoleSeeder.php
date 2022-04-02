<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
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
                'name' => 'Admin',
                'slug' => 'admin',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => 'Branch Manager',
                'slug' => 'branch-manager',
                'status' => 1,
                'created_at' => time()
            ],
            [
                'name' => 'Account Manager',
                'slug' => 'account-manager',
                'status' => 1,
                'created_at' => time()
            ],  
            
        ];
        foreach ($input as $val) {
            Role::firstOrCreate($val);
        }
    }
}
