<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
//Modelo de los roles
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    //Metodo para proteger vistas
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit,update');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        //Accede a los valores de user
        //Accede a la relacion de roles
        //Sync Ingresa los valores de un Array seleccionados y elimina en caso de ya tener registros en la BD
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user)->with('info', 'Se asignó los roles correctamente');
    }
}
