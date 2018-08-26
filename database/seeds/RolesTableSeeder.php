<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super-user', 'display_name' => 'Super User', 'description' => 'Super use role admin']);

        Role::create(['name' => 'pilot', 'display_name' => 'Pilot role', 'description' => 'Pilot role permission']);
    }
}
