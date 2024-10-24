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
        Permission::firstOrCreate(['name' => 'view stocks']);
        Permission::firstOrCreate(['name' => 'edit stocks']);
        Permission::firstOrCreate(['name' => 'view products']);
        Permission::firstOrCreate(['name' => 'edit products']);
        

        // Verificar e criar papéis se ainda não existirem
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(['edit stocks', 'view stocks', 'edit products', 'view products']);

        $leader = Role::firstOrCreate(['name' => 'leader']);
        $leader->givePermissionTo(['view stocks', 'view products', 'edit products']);

        $trafego = Role::firstOrCreate(['name' => 'trafego']);
        $trafego->givePermissionTo('view products');

        $criacao = Role::firstOrCreate(['name' => 'criacao']);
        $criacao->givePermissionTo('view products');

        $assessoria = Role::firstOrCreate(['name' => 'assessoria']);
        $assessoria->givePermissionTo('view products');

        $tele = Role::firstOrCreate(['name' => 'tele']);
        $tele->givePermissionTo('view products');

        $vendas = Role::firstOrCreate(['name' => 'vendas']);
        $vendas->givePermissionTo('view products');       
    }
}
