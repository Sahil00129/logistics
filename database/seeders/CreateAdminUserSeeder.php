<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\UserRole
use App\models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@yopmail.com',
                'password' => '123456',
                // 'password' => Hash::make('admin786'), // secret
                'role_id' => Role::where('name', 'owner')->first()->id,
                'status' => 1,
                'created_at' => time(),
            ],
            
        ];

        
        foreach ($users as $val) {
           $createduser =  User::firstOrCreate($val);
                $userrole = [
                    'user_id'=>$createduser->id,
                    'role_id'=>$createduser->role_id,
                    'status'=>'1',
                ];
                    
           UserRole::create($userrole);
        }
       
    }
}
