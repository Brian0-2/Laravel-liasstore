<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// php artisan make:controller UserController --model=User -r

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::where('name', '!=' ,'admin')->get();
        $permissions = Permission::all();

        return view('layouts.admin.users.edit', [
            'roles' => $roles,
            'permissions' => $permissions,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        // Sincronizar roles y permisos
        if($request -> has('permissions') && !$request -> has('roles')){
            $user -> syncPermissions([]);
            $user -> syncRoles([]);

            return redirect()->back()->withErrors(['roles' => 'Debes seleccionar al menos un rol si asignas permisos.']);

        } elseif ($request->has('roles') && !$request->has('permissions')) {
            $user->roles()->sync($request->roles);
            $user -> syncPermissions([]);

        } elseif($request->has('roles') && $request->has('permissions')) {
            // Si no se envían permisos en la solicitud, se pueden eliminar todos los permisos del usuario
            $user->permissions()->sync($request->permissions);
            $user->roles()->sync($request->roles);
        }else{
            $user -> syncRoles([]);
            $user -> syncPermissions([]);
        }

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('message-updated', 'Usuario: ' . $user->name . ' con id: ' . $user->id . ' fue Actualizado Correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route('users.index')
            ->with('message-deleted', 'Usuario: ' . $user->name . ' con id: ' . $user->id . ' fue eliminado Correctamente!');
    }
}
