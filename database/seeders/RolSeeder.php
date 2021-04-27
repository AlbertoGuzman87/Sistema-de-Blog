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
        // el campo de la bd , 'description' => 'Ver el Dashboard'
        Permission::create(['name' => 'admin.home', 'description' => 'Ver el Dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update', 'description' => 'Asignar rol a usuarios'])->syncRoles([$role1]);

        //Rutas de las categorias
        //Crea el permiso y se lo asigna al rol 1 y 2
        Permission::create(['name' => 'admin.categories.index', 'description' => 'Ver listado de categorias'])->syncRoles([$role1, $role2]);
        //Crea el permiso y se lo asigna al rol 1
        Permission::create(['name' => 'admin.categories.create', 'description' => 'Crear una nueva categoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit', 'description' => 'Editar categorias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy', 'description' => 'Eliminar categorias'])->syncRoles([$role1]);

        //Rutas de las tags
        //Crea el permiso y se lo asigna al rol 1 y 2
        Permission::create(['name' => 'admin.tags.index', 'description' => 'Ver listado de etiquetas'])->syncRoles([$role1, $role2]);
        //Crea el permiso y se lo asigna al rol 1
        Permission::create(['name' => 'admin.tags.create', 'description' => 'Crear nuevas etiqueta'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit', 'description' => 'Editar etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy', 'description' => 'Eliminar etiquetas'])->syncRoles([$role1]);

        //Rutas de los Posts
        //Crea el permiso y se lo asigna al rol 1 y 2
        Permission::create(['name' => 'admin.posts.index', 'description' => 'Ver listado de posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create', 'description' => 'Crear nuevos posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit', 'description' => 'Editar posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy', 'description' => 'Eliminar posts'])->syncRoles([$role1, $role2]);
    }
}
