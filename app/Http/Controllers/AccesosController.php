<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabajadorLoginRequest;
use App\Models\Accesos;
use App\Models\Empresa;
use App\Models\Trabajadores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccesosController extends Controller
{

    public function dashboardTrabajador(TrabajadorLoginRequest $request)
    {
        $acceso = Accesos::where('password', $request->password)->where('active', 1)->first();
        $trabajador = Trabajadores::where('id', $acceso->idTrabajador)->where('active', 1)->first();
        $empresa = Empresa::where('id', $trabajador->idEmpresa)->where('active', 1)->first();
        // Guardar los datos en la sesión

        session([
            'trabajador' => $trabajador,
            'empresa' => $empresa,
            'password' => $request->password
        ]);

        return redirect()->route('menuDeTurnosTrabajador');
    }

    public function MenuTrabajador()
    {
        // Obtener los datos de la sesión
        $trabajador = session('trabajador');
        $empresa = session('empresa');
        $password = session('password');

        return view('accesos.turnosMenu', compact('trabajador', 'empresa', 'password'));
    }

    public function MenuTurnosTrabajador($id, $hash)
    {
        $acceso = Accesos::where('password', $hash)->where('active', 1)->first();
        $trabajador = Trabajadores::where('id', $id)->where('active', 1)->first();
        $empresa = Empresa::where('id', $trabajador->idEmpresa)->where('active', 1)->first();

        $data = [
            'trabajador' => $trabajador,
            'empresa' => $empresa,
            'password' => $hash
        ];

        if ($acceso->idTrabajador == $id) {
            return view('accesos.turnosMenu', $data);
        } else {
            return view('accesos.denegado');
        }
    }

    public function dashboard($token)
    {
        $tokenVerif = Accesos::where('hash', $token)->where('active', 1)->first();

        if ($tokenVerif !== null) {
            $empresa = Empresa::where('id', $tokenVerif->idEmpresa)->where('active', 1)->first();

            $data = [
                'empresa' => $empresa,
            ];

            return view('accesos.dashboardLogin', $data);
        } else {
            return view('accesos.fail');
        }
    }

    public function TrabajadorAcceso($id)
    {
        $acceso = Accesos::where('idTrabajador', $id)->where('active', 1)->first();
        $link = route('TrabajadorDashboard', ['token' => $acceso->hash]);

        $data = [
            'password' => $acceso->password,
            'link' => $link
        ];

        return view('empresa.accesoid', $data);
    }

    public function accesos()
    {
        $user = Auth::user();
        $empresa = Empresa::where('idUser', $user->id)->where('active', 1)->first();
        $trabajadores = Trabajadores::where('idEmpresa', $empresa->id)->where('active', 1)->get();

        $data = [
            'trabajadores' => $trabajadores
        ];

        return view('empresa.accesos', $data);
    }
}
