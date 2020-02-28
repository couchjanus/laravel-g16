<?php

use Illuminate\Database\Seeder;
use App\Permission;
use Illuminate\Support\Str;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Удаляем предыдущие данные
        DB::table('permissions')->truncate();

        $permissions = array(
            array('name' => 'Can Create Permission'),
            array('name' => 'Can Edit Permission'),
            array('name' => 'Can Show Permission'),
            array('name' => 'Can Delete Permission'),
            array('name' => 'Can Access Permission'),
            array('name' => 'Can Create Role'),
            array('name' => 'Can Edit Role'),
            array('name' => 'Can Show Role'),
            array('name' => 'Can Delete Role'),
            array('name' => 'Can Access Role'),
            array('name' => 'Can Create User'),
            array('name' => 'Can Edit User'),
            array('name' => 'Can Show User'),
            array('name' => 'Can Delete User'),
            array('name' => 'Can Access User'),
        );
        
        /** Add Permissions    */
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'slug' => Str::slug($permission['name']),
            ]);
        }
    }
}
