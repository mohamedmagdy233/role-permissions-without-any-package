<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = Admin::create([
           'name' => 'abdallah',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123'),
        ]);

        // create role
        Role::create([
            'name' => 'admin',
        ]);

        $allPermissions = Permission::all();
        $role = Role::where('name', 'admin')->first();

        foreach ($allPermissions as $permission) {

            RoleHasPermission::create([
                'role_id' => $role->id,
                'permission_id' => $permission->id,
            ]);
        }
        RoleUser::Create([
            'role_id' => $role->id,
            'admin_id' => $admin->id
        ]);
    }
}
