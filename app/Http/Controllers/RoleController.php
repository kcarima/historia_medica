<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    // Formulario de creación
    public function create()
    {
        return view('roles.create');
    }

    // Almacenar nuevo rol
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255',
            'description' => 'nullable|string'
        ]);

        Role::create($validated);
        return redirect()->route('roles.index');
    }

    // Formulario de edición
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Actualizar rol
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:roles,name,'.$role->id,
            'description' => 'nullable|string'
        ]);

        $role->update($validated);
        return redirect()->route('roles.index');
    }

    // Eliminar rol
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }

}