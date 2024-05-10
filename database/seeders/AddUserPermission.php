<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AddUserPermission extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
   public function run()
    {
        // \App\Models\User::factory(10)->create();
        $permissions = [
            'user-list',
            'user-add',
            'user-edit',
            'user-delete',
         ];
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
         }
    }
}
