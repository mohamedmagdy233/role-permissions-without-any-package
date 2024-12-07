<?php

namespace Database\Seeders;

use App\Enums\permissionEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (permissionEnum::cases() as $case) {
            foreach ($case->permissions() as $permission) {
                // Insert all permissions at once
                Permission::query()
                    ->updateOrCreate([
                        'name' => $permission,
                    ], [
                        'name' => $permission,
                    ]);
            }
        }
    }
}
