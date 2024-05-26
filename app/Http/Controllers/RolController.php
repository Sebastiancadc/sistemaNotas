<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::all();
            return view('roles.index', compact('roles'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al listar los roles' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:roles,name',
            ]);
            Role::create($request->all());
            return redirect()->route('rol.index')
                ->with('success', 'Rol creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al crear el rol ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);
            $request->validate([
                'name' => 'required|unique:roles,name,' . $role->id,
            ]);
            $role->update($request->all());
            return redirect()->route('rol.index')
                ->with('success', 'Rol actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al editar el rol ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('rol.index')->with('success', 'Rol eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al eliminar el rol ' . $e->getMessage());
        }
    }
}
