<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions ENCOMENDAS
        Permission::create(['name' => 'encomenda-incluir']);
        Permission::create(['name' => 'encomenda-excluir']);
        Permission::create(['name' => 'encomenda-listar-pendente']);
        Permission::create(['name' => 'encomenda-listar-solicitada']);
        Permission::create(['name' => 'encomenda-listar-entregue']);
        Permission::create(['name' => 'encomenda-listar-cancelada']);
        Permission::create(['name' => 'encomenda-confirmar-compra']);
        Permission::create(['name' => 'encomenda-comfirmar-entrega']);
        Permission::create(['name' => 'encomenda-visualizar-pendente']);
        Permission::create(['name' => 'encomenda-visualizar-entregue']);
        Permission::create(['name' => 'encomenda-visualizar-cancelada']);
        Permission::create(['name' => 'encomenda-visualizar-solicitada']);
        Permission::create(['name' => 'encomenda-cancelar-entrega']);
        Permission::create(['name' => 'encomenda-cancelar-solicitacao']);

        // // Create Permissions GRUPOS
        Permission::create(['name' => 'grupo-listar']);
        Permission::create(['name' => 'grupo-atribuir-acessos']);
        Permission::create(['name' => 'grupo-remover-acessos']);

        // this can be done as separate statements
        $role = Role::create(['name' => 'Atendente']);
        $role->givePermissionTo('encomenda-listar-pendente');
        $role->givePermissionTo('encomenda-listar-solicitada');
        $role->givePermissionTo('encomenda-listar-entregue');

        $role = Role::create(['name' => 'Administrador']);
        $role->givePermissionTo(Permission::all());
    }
}
