<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Importa el modelo role
use Spatie\Permission\Models\Role;
//Importa el modelo Permission
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);
        //Se guarda el nombre del rol en la tabla role
        $role = Role::create($request->all());
        //Se gurarda en la tabla model_has_permissions
        //Accedemos a la relacion permissions y le mandamos los chequed seleccionados
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->with('info', 'El rol se creó con exitó');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            // Que sea unico en la tabala roles ignorando su propio ID
            'name' => "required|unique:roles,name,$role->id",
        ]);
        //Actualiza el nombre del rol en la tabla role
        $role->update($request->all());
        //Se gurarda en la tabla model_has_permissions
        //Accedemos a la relacion permissions y le mandamos los chequed nuevos seleccionados
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->with('info', 'El rol se actualizó con exitó');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index', $role)->with('info', 'El rol se eliminó con exitó');
    }
}
