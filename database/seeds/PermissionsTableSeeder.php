<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$permission = [        
			['name' => 'role-list','display_name' => 'Role - Listing Display','description' => 'See only Listing Of Role'],
			['name' => 'role-create','display_name' => 'Role - Create','description' => 'Create New Role'],
			['name' => 'role-edit','display_name' => 'Role - Edit','description' => 'Edit Role'],
			['name' => 'role-delete','display_name' => 'Role - Delete','description' => 'Delete Role'],
			
			['name' => 'user-list','display_name' => 'User -  Listing Display','description' => 'See only Listing Of Users'],
			['name' => 'user-create','display_name' => 'User - Create','description' => 'Create New User'],
			['name' => 'user-edit','display_name' => 'User - Edit','description' => 'Edit User'],
			['name' => 'user-delete','display_name' => 'User - Delete','description' => 'Delete User'],
			
			['name' => 'permission-list','display_name' => 'Permission - Listing Display','description' => 'Permission listing display option'],
			['name' => 'permission-create','display_name' => 'Permission - Create','description' => 'Permission create role'],
			['name' => 'permission-edit','display_name' => 'Permission - Edit','description' => 'Edit permission edit'],
			['name' => 'permission-delete','display_name' => 'Permission - Delete','description' => 'Permission delete option'],
			
			
		];

		foreach ($permission as $key => $value) {
        	Permission::create($value);
        }

    }
}
