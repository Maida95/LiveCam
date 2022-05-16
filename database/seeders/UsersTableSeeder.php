<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        //Create roles
        $adminRole = Role::where('name','admin')->first();
        $livecamRole = Role::where('name','livecam_user')->first();
        $webshopRole = Role::where('name','webshop_user')->first();

        //Create users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);

        $livecam_user = User::create([
            'name' => 'LiveCam User',
            'email' => 'livecam_user@user.com',
            'password' => Hash::make('livecam')
        ]);

        $webshop_user = User::create([
            'name' => 'WebShop User',
            'email' => 'webshop_user@user.com',
            'password' => Hash::make('webshop')
        ]);

        //Asign roles
        $admin->roles()->attach($adminRole);
        $livecam_user->roles()->attach($livecamRole);
        $webshop_user->roles()->attach($webshopRole);
    }
}
