<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdatePerfilRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ConfigurationController extends Controller
{
    public function UserConfiguration()
    {
        $user = Auth::user();
        $data = [
            'user' => $user
        ];
        return view('config.panel', $data);
    }

    public function UpdatePerfil(UpdatePerfilRequest $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->input('nombre'); // Asegúrate de que el campo en la base de datos sea 'name' y no 'nombre'
        $user->email = $request->input('email');
        $user->telefono = $request->input('telefono'); // Asegúrate de que el campo en la base de datos sea 'phone' y no 'telefono'

        // Guarda los cambios en la base de datos
        $user->save();

        // Opcional: Redirige o muestra un mensaje de éxito
        return redirect()->back()->with('message', 'Perfil actualizado correctamente.');
    }

    public function UpdatePassword(UpdatePasswordRequest $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $actualPassword = $request->oldPassword;
        $NuevaPassword = $request->newPassword;

        // Verifica si la contraseña actual proporcionada coincide con la contraseña almacenada en la base de datos
        if (!Hash::check($actualPassword, $user->password)) {
            // La contraseña actual no coincide
            return redirect()->back()->withErrors(['oldPassword' => 'La contraseña actual es incorrecta.']);
        }

        // Si la contraseña es correcta, actualiza la contraseña del usuario
        $user->password = Hash::make($NuevaPassword);
        $user->save();

        return redirect()->back()->with('message', 'Contraseña actualizada correctamente.');
    }
}
