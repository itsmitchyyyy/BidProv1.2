<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name','admin')->first();
        $role_bidder = Role::where('name','bidder')->first();
        $role_seeker = Role::where('name','seeker')->first();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@bidpro.com';
        $admin->username = 'admin';
        $admin->password = bcrypt('admin!@#');
        $admin->avatar = '/uploads/blank.png';
        $admin->save();
        $admin->roles()->attach($role_admin);

        $bidder = new User();
        $bidder->name = 'bidder';
        $bidder->email = 'bidder@bidpro.com';
        $bidder->username = 'bidder';
        $bidder->password = bcrypt('bidder!@#');
        $bidder->avatar = '/uploads/blank.png';
        $bidder->save();
        $bidder->roles()->attach($role_bidder);
    
        $seeker = new User();
        $seeker->name = 'seeker';
        $seeker->email = 'seeker@bidpro.com';
        $seeker->username = 'seeker';
        $seeker->password = bcrypt('seeker!@#');
        $seeker->avatar = '/uploads/blank.png';
        $seeker->save();
        $seeker->roles()->attach($role_seeker);
    }
}
