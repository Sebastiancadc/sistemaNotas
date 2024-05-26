<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Muestra una lista de los usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::all();
            $roles = Role::all();
            return view('users.index', compact('users', 'roles'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al listar los usuarios: ' . $e->getMessage());
        }
    }

    /**
     * Almacena un usuario recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validación de los datos del formulario
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);

            // Crear el usuario 
            $user = User::create($request->all());
            $role = Role::where('name', $request->rol)->first();
            // Asignar el rol al usuario
            $user->assignRole($role);

            return redirect()->route('users.index')
                ->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al crear el usuario: ' . $e->getMessage());
        }
    }


    /**
     * Actualiza el usuario especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            // Validación de los datos del formulario
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id
            ]);

            // Actualizar el usuario
            $user->update($request->all());

            // Obtener el rol seleccionado del formulario
            $role = Role::where('name', $request->rol)->first();

            // Quitar todos los roles anteriores del usuario
            $user->roles()->detach();

            // Asignar el nuevo rol al usuario
            $user->assignRole($role);

            return redirect()->route('users.index')
                ->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al actualizar el usuario: ' . $e->getMessage());
        }
    }


    /**
     * Elimina el usuario especificado de la base de datos.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            // Eliminar el usuario
            $user->delete();

            return redirect()->route('users.index')
                ->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}
