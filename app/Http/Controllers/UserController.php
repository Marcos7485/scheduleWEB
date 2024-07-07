<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\RegistroPostRequest;
use App\Models\Disponibilidad;
use App\Models\GlobalHash;
use App\Models\User;
use App\Services\TurnosSrv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $TurnosSrv;

    public function __construct(TurnosSrv $TurnosSrv)
    {
        $this->TurnosSrv = $TurnosSrv;
    }
    public function registro(RegistroPostRequest $request)
    {
        $user = new User();
        $disponibilidad = new Disponibilidad();
        $globalHash = new GlobalHash();

        // User
        $user->idEmpresa = null;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = null;
        $user->telefono = $request->telefono;
        $user->email_verified_at = null;
        $user->password = Hash::make($request->password);
        $user->active = "1";

        $user->save();

        Auth::login($user);

        // Disponibilidad 

        $disponibilidad->idUser = $user->id;
        $disponibilidad->lunes = json_encode("Cerrado");
        $disponibilidad->martes = json_encode("Cerrado");
        $disponibilidad->miercoles = json_encode("Cerrado");
        $disponibilidad->jueves = json_encode("Cerrado");
        $disponibilidad->viernes = json_encode("Cerrado");
        $disponibilidad->sabado = json_encode("Cerrado");
        $disponibilidad->domingo = json_encode("Cerrado");
        $disponibilidad->lapsos = "30";
        $disponibilidad->active = "1";

        $disponibilidad->save();

        
        // Hash Global
        
        $globalHash->idUser = $user->id;
        $globalHash->hash = $this->TurnosSrv->TurnosHashGen();
        $globalHash->lapso = '30';
        $globalHash->active = "1";

        $globalHash->save();


        return redirect(route('dashboard'));
    }



    public function login(LoginPostRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        $bool = true;


        $data = [
            'menu' => $bool,
        ];
 

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard', $data));
        }

        return redirect()->back()->withErrors([
            'error' => 'El email o la contraseña estan incorrectos',
        ]);
    }




    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('welcome'));
    }
}
