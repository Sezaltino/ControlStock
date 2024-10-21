<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Verificar e criar permissões se ainda não existirem
        Permission::firstOrCreate(['name' => 'edit and look stocks']);
        Permission::firstOrCreate(['name' => 'view out stocks']);
        Permission::firstOrCreate(['name' => 'edit products']);

        // Verificar e criar papéis se ainda não existirem
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(['edit and look stocks', 'view out stocks', 'edit products']);

        $trafego = Role::firstOrCreate(['name' => 'trafego']);
        $trafego->givePermissionTo('edit and look stocks');
    }
}
