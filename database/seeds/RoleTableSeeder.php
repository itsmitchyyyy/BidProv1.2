<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();
        
        $bidder = new Role();
        $bidder->name = 'bidder';
        $bidder->save();

        $seeker = new Role();
        $seeker->name = 'seeker';
        $seeker->save();
    }
}
