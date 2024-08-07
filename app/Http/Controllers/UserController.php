<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\RecoveryEmailRequest;
use App\Http\Requests\RecoveryPasswordRequest;
use App\Http\Requests\RecoveryPasswordResquest;
use App\Http\Requests\RegistroPostRequest;
use App\Mail\PasswordUpdate;
use App\Mail\UserRecovery;
use App\Mail\UserRegister;
use App\Models\Disponibilidad;
use App\Models\EmailVerificationHash;
use App\Models\GlobalHash;
use App\Models\RecoveryHash;
use App\Models\User;
use App\Models\UserPlan;
use App\Services\TurnosSrv;
use Carbon\Carbon;
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
        $userVerification = User::where('email', $request->email)->first();
        if ($userVerification == null) {
            $user = new User();
            $disponibilidad = new Disponibilidad();
            $globalHash = new GlobalHash();
            $userPlan = new UserPlan();

            // user
            $user->idEmpresa = null;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = null;
            $user->telefono = $request->telefono;
            $user->email_verified_at = null;
            $user->password = Hash::make($request->password);
            $user->active = 0;
            $user->save();

            // user - Disponibilidad
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

            // user - Global Link
            $globalHash->idUser = $user->id;
            $globalHash->hash = $this->TurnosSrv->TurnosHashGen();
            $globalHash->lapso = '30';
            $globalHash->active = "1";
            $globalHash->save();

            // user - Plan
            $userPlan->idUser = $user->id;
            $userPlan->idPlan = null;
            $userPlan->vencimiento = Carbon::now()->addDays(30);
            $userPlan->active = 1;
            $userPlan->save();

            // user - email validations
            $EmailToken = new EmailVerificationHash();
            $EmailToken->idUser = $user->id;
            $EmailToken->hash = $this->TurnosSrv->TurnosHashGen();
            $EmailToken->active = 1;
            $EmailToken->save();

            Mail::to($user->email)->send(new UserRegister($user, $EmailToken->hash));

            return redirect(route('emailvalidateview'));
        } else {
            return redirect(route('registro'))->with('error', 'El Email ya se encuentra en uso');
        }
    }

    public function emailvalidateview()
    {
        return view('session.verificarEmail');
    }

    public function EmailValidated()
    {
        return view('session.emailvalidated');
    }

    public function RecuperarPasswordView()
    {
        return view('session.recovery');
    }

    public function recovery(RecoveryEmailRequest $request)
    {
        $user = User::where('email', $request->email)->where('active', 1)->first();

        if ($user !== null) {
            $verificador = RecoveryHash::where('idUser', $user->id)->where('active', 1)->first();

            if ($verificador == null) {
                $recoveryHash = new RecoveryHash();
                $recoveryHash->idUser = $user->id;
                $recoveryHash->hash = $this->TurnosSrv->TurnosHashGen();
                $recoveryHash->active = 1;
                $recoveryHash->save();


                Mail::to($user->email)->send(new UserRecovery($user, $recoveryHash->hash));

                return redirect()->route('recuperar.password')->with('message', 'Email de recuperación enviado');
            } else {
                return redirect()->route('recuperar.password')->with('error', 'El email de recuperacion ya fue anteriormente enviado');
            }
        } else {
            return redirect()->route('recuperar.password')->with('error', 'El email no esta vinculado a un usuario validado');
        }
    }

    public function accountrecovery($token)
    {
        $recoveryVerificator = RecoveryHash::where('hash', $token)->where('active', 1)->first();


        if ($recoveryVerificator !== null) {
            $user = User::where('id', $recoveryVerificator->idUser)->where('active', 1)->first();
            $data = [
                'idUser' => $user->id
            ];

            return view('session.recoveryForm', $data);
        } else {
            die('es null');
            return redirect()->route('recuperar.password')->with('error', 'El email de recuperacion ya fue utilizado o es inexistente');
        }
    }

    public function passwordreset(RecoveryPasswordRequest $request)
    {
        $user = User::where('id', $request->id)->where('active', 1)->first();
        $recoveryHash = RecoveryHash::where('idUser', $user->id)->where('active', 1)->first();
        $recoveryHash->active = 0;
        $user->password = Hash::make($request->password);
        $user->save();
        Mail::to($user->email)->send(new PasswordUpdate($user, $request->password));
        return redirect()->route('login')->with('message', 'Contraseña modificada con éxito');
    }

    public function EmailVerificationUser($token)
    {
        $EmailVerification = EmailVerificationHash::where('hash', $token)->where('active', 1)->first();

        if ($EmailVerification !== null) {

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
