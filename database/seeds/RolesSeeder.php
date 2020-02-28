<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        $roles = array(
            array('name' => 'Admin'),
            array('name' => 'Manager'),
            array('name' => 'Writer'),
            array('name' => 'User'),
            array('name' => 'Customer'),
            array('name' => 'Unverified'),
        );
        
        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'slug' => Str::slug($role['name']),
            ]);
        }
    }
}
