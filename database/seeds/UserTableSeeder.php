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
        $admin->firstname = 'admin';
        $admin->lastname = 'admin';
        $admin->email = 'admin@bidpro.com';
        $admin->username = 'admin';
        $admin->password = bcrypt('admin!@#');
        $admin->avatar = 'uploads/blank.png';
        $admin->save();
        $admin->roles()->attach($role_admin);

        $bidder = new User();
        $bidder->firstname = 'bidder';
        $bidder->lastname = 'bidder';
        $bidder->email = 'bidder@bidpro.com';
        $bidder->username = 'bidder';
        $bidder->password = bcrypt('bidder!@#');
        $bidder->avatar = 'uploads/blank.png';
        $bidder->save();
        $bidder->roles()->attach($role_bidder);
    
        $seeker = new User();
        $seeker->firstname = 'seeker';
        $seeker->lastname = 'seeker';
        $seeker->email = 'seeker@bidpro.com';
        $seeker->username = 'seeker';
        $seeker->password = bcrypt('seeker!@#');
        $seeker->avatar = 'uploads/blank.png';
        $seeker->save();
        $seeker->roles()->attach($role_seeker);

        $kim = new User();
        $kim->firstname = 'Kimberly';
        $kim->lastname = 'Ready GO';
        $kim->email = 'kimberlygo@gmail.com';
        $kim->username = 'kimmynonawa';
        $kim->password = bcrypt('kimmygostop');
        $kim->avatar = 'uploads/26167765_892665504241346_8709188143586034821_n.jpg';
        $kim->save();
        $kim->roles()->attach($role_seeker);
    }
}
