<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\RegistroPostRequest;
use App\Mail\UserRegister;
use App\Models\Disponibilidad;
use App\Models\EmailVerificationHash;
use App\Models\GlobalHash;
use App\Models\User;
use App\Services\TurnosSrv;
use Egulias\EmailValidator\EmailValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        $user->idEmpresa = null;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = null;
        $user->telefono = $request->telefono;
        $user->email_verified_at = null;
        $user->password = Hash::make($request->password);
        $user->active = 0;
        $user->save();

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

        $globalHash->idUser = $user->id;
        $globalHash->hash = $this->TurnosSrv->TurnosHashGen();
        $globalHash->lapso = '30';
        $globalHash->active = "1";

        $globalHash->save();

        $EmailToken = new EmailVerificationHash();
        $EmailToken->idUser = $user->id;
        $EmailToken->hash = $this->TurnosSrv->TurnosHashGen();
        $EmailToken->active = 1;
        $EmailToken->save();

        Mail::to($user->email)->send(new UserRegister($user, $EmailToken->hash));

        return redirect(route('emailvalidateview'));
    }

    public function emailvalidateview()
    {
        return view('session.verificarEmail');
    }

    public function EmailValidated()
    {
        return view('session.emailvalidated');
    }

    public function RecuperarPassword(){
        die('Desarrollar');
    }

    public function EmailVerificationUser($token)
    {
        $EmailVerification = EmailVerificationHash::where('hash', $token)->where('active', 1)->first();

        if($EmailVerification !== null){

            $user = User::where('id', $EmailVerification->idUser)->first();
            $EmailVerification->active = 0;
            $EmailVerification->save();

            $user->active = 1;
            $user->email_verified_at = now();
            $user->save();

            return redirect(route('validated.email'));
        } else {
            return redirect(route('login'));
        }
    }

    public function login(LoginPostRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        $bool = true;

        $userVerification = User::where('email', $request->email)->first();

        if ($userVerification->active == 1) {
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
        } else {
            return redirect(route('emailvalidateview'));
        }
    }




    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('welcome'));
    }
}
