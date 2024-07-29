<?php

namespace App\Http\Controllers;

use App\Models\Disponibilidad;
use App\Models\GlobalHash;
use App\Services\DispSrv;
use App\Services\TrabSrv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisponibilidadController extends Controller
{
    protected $DispSrv;

    public function __construct(DispSrv $DispSrv)
    {
        $this->DispSrv = $DispSrv;
    }

    public function disp()
    {

        $user = Auth::user();
        $Disponibilidad = $this->DispSrv->DUsuarioId($user->id);

        $data = [
            "info" => $Disponibilidad,
            "lunes" => json_decode($Disponibilidad->lunes),
            "martes" => json_decode($Disponibilidad->martes),
            "miercoles" => json_decode($Disponibilidad->miercoles),
            "jueves" => json_decode($Disponibilidad->jueves),
            "viernes" => json_decode($Disponibilidad->viernes),
            "sabado" => json_decode($Disponibilidad->sabado),
            "domingo" => json_decode($Disponibilidad->domingo),
            "lapsos" => $Disponibilidad->lapsos
        ];

        return view('dashboard.disp', $data);
    }


    public function update(Request $request)
    {

        // Acceder a un campo específico del formulario
        $estadoLunes = $request->input('estadolunes');
        $estadoMartes = $request->input('estadomartes');
        $estadoMiercoles = $request->input('estadomiercoles');
        $estadoJueves = $request->input('estadojueves');
        $estadoViernes = $request->input('estadoviernes');
        $estadoSabado = $request->input('estadosabado');
        $estadoDomingo = $request->input('estadodomingo');
        $lunes = [];
        $martes = [];
        $miercoles = [];
        $jueves = [];
        $viernes = [];
        $sabado = [];
        $domingo = [];
        if ($estadoLunes == "Abierto") {
            $aplunes = $request->input('lunesaphr');
            $aplunesmin = $request->input('lunesapmin');
            $cllunes = $request->input('lunesclhr');
            $cllunesmin = $request->input('lunesclmin');
            array_push($lunes, $aplunes);
            array_push($lunes, $aplunesmin);
            array_push($lunes, $cllunes);
            array_push($lunes, $cllunesmin);
        } else {
            $lunes = "Cerrado";
        }

        if ($estadoMartes == "Abierto") {
            $apmartes = $request->input('maraphr');
            $apmartesmin = $request->input('marapmin');
            $clmartes = $request->input('marclhr');
            $clmartesmin = $request->input('marclmin');
            array_push($martes, $apmartes);
            array_push($martes, $apmartesmin);
            array_push($martes, $clmartes);
            array_push($martes, $clmartesmin);
        } else {
            $martes = "Cerrado";
        }


        if ($estadoMiercoles == "Abierto") {
            $apmiercoles = $request->input('mieraphr');
            $apmiercolesmin = $request->input('mierapmin');
            $clmiercoles = $request->input('miercolesclhr');
            $clmiercolesmin = $request->input('miercolesclmin');
            array_push($miercoles, $apmiercoles);
            array_push($miercoles, $apmiercolesmin);
            array_push($miercoles, $clmiercoles);
            array_push($miercoles, $clmiercolesmin);
        } else {
            $miercoles = "Cerrado";
        }

        if ($estadoJueves == "Abierto") {
            $apjueves = $request->input('juevesaphr');
            $apjuevesmin = $request->input('juevesapmin');
            $cljueves = $request->input('juevesclhr');
            $cljuevesmin = $request->input('juevesclmin');
            array_push($jueves, $apjueves);
            array_push($jueves, $apjuevesmin);
            array_push($jueves, $cljueves);
            array_push($jueves, $cljuevesmin);
        } else {
            $jueves = "Cerrado";
        }

        if ($estadoViernes == "Abierto") {
            $apviernes = $request->input('viernesaphr');
            $apviernesmin = $request->input('viernesapmin');
            $clviernes = $request->input('viernesclhr');
            $clviernesmin = $request->input('viernesclmin');
            array_push($viernes, $apviernes);
            array_push($viernes, $apviernesmin);
            array_push($viernes, $clviernes);
            array_push($viernes, $clviernesmin);
        } else {
            $viernes = "Cerrado";
        }

        if ($estadoSabado == "Abierto") {
            $apsabado = $request->input('sabadoaphr');
            $apsabadomin = $request->input('sabadoapmin');
            $clsabado = $request->input('sabadoclhr');
            $clsabadomin = $request->input('sabadoclmin');
            array_push($sabado, $apsabado);
            array_push($sabado, $apsabadomin);
            array_push($sabado, $clsabado);
            array_push($sabado, $clsabadomin);
        } else {
            $sabado = "Cerrado";
        }

        if ($estadoDomingo == "Abierto") {
            $apdomingo = $request->input('domingoaphr');
            $apdomingomin = $request->input('domingoapmin');
            $cldomingo = $request->input('domingoclhr');
            $cldomingomin = $request->input('domingoclmin');
            array_push($domingo, $apdomingo);
            array_push($domingo, $apdomingomin);
            array_push($domingo, $cldomingo);
            array_push($domingo, $cldomingomin);
        } else {
            $domingo = "Cerrado";
        }


        $user = Auth::user();

        Disponibilidad::updateOrCreate(
            ['idUser' => $user->id], // Condición para encontrar el registro existente
            [
                'lunes' => json_encode($lunes),
                'martes' => json_encode($martes),
                'miercoles' => json_encode($miercoles),
                'jueves' => json_encode($jueves),
                'viernes' => json_encode($viernes),
                'sabado' => json_encode($sabado),
                'domingo' => json_encode($domingo)
            ]
        );

        return redirect(route('disponibilidad'));
    }

    public function updateTodas(Request $request)
    {

        $estadoTodas = $request->input('estadotodas');

        $todas = [];

        if ($estadoTodas == "Abierto") {
            $aphr = $request->input('todashr');
            $apmin = $request->input('todasmin');
            $clhr = $request->input('todasclhr');
            $clmin = $request->input('todasclmin');
            array_push($todas, $aphr);
            array_push($todas, $apmin);
            array_push($todas, $clhr);
            array_push($todas, $clmin);
        } else {
            $todas = "Cerrado";
        }

        $user = Auth::user();

        Disponibilidad::updateOrCreate(
            ['idUser' => $user->id], // Condición para encontrar el registro existente
            [
                'lunes' => json_encode($todas),
                'martes' => json_encode($todas),
                'miercoles' => json_encode($todas),
                'jueves' => json_encode($todas),
                'viernes' => json_encode($todas),
                'sabado' => json_encode($todas),
                'domingo' => json_encode($todas)
            ]
        );

        return redirect(route('disponibilidad'));
    }

    public function updateLapsos(Request $request)
    {
        $duracion = $request->input('lapsos');

        $user = Auth::user();

        Disponibilidad::updateOrCreate(
            ['idUser' => $user->id], // Condición para encontrar el registro existente
            [
                'lapsos' => $duracion
            ]
        );

        return redirect(route('disponibilidad'));
    }


    public function updateLapsosTurnos(Request $request)
    {
        $duracion = $request->input('lapsos');

        $user = Auth::user();

        Disponibilidad::updateOrCreate(
            ['idUser' => $user->id], // Condición para encontrar el registro existente
            [
                'lapsos' => $duracion
            ]
        );

        return redirect(route('darTurnos'));
    }


    public function updateLapsoGlobalHash(Request $request)
    {
        $duracion = $request->input('lapsos');

        $user = Auth::user();

        GlobalHash::updateOrCreate(
            ['idUser' => $user->id], // Condición para encontrar el registro existente
            [
                'lapso' => $duracion
            ]
        );
        return redirect(route('geral-link'));
    }


    public function dispoedit()
    {
        $user = Auth::user();
        $disponibilidad = Disponibilidad::where('idUser', $user->id)->get();

        $data = [
            "info" => $disponibilidad[0],
        ];

        return view('disponibilidad.form1', $data);
    }
}
