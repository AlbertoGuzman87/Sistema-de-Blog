<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Importa el modelo role
use Spatie\Permission\Models\Role;

//Importa los permisos
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Blogger']);

        //Permisos
        //Ruta del dashboard
        //Crea el permiso y se lo asigna al rol 1 y 2
        Permission::create(['name' => 'admin.index'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1]);

        //Rutas de las categorias
        //Crea el permiso y se lo asigna al rol 1
        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy'])->syncRoles([$role1]);

        //Rutas de las tags
        //Crea el permiso y se lo asigna al rol 1
        Permission::create(['name' => 'admin.tags.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy'])->syncRoles([$role1]);

        //Rutas de los Posts
        //Crea el permiso y se lo asigna al rol 1 y 2
        Permission::create(['name' => 'admin.posts.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy'])->syncRoles([$role1, $role2]);
    }
}
