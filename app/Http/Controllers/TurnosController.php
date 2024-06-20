<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Disponibilidad;
use App\Models\Turnos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurnosController extends Controller
{

    public function TurnosHoy()
    {
        $user = Auth::user();
        // DATES:
        Carbon::setLocale('es');
        $diahoy = Carbon::now()->translatedFormat('l');  // 'l' representa el día completo de la semana
        $numerohoy = Carbon::now()->format('d');     
        $month = Carbon::now()->format('m');    // 'F' para el nombre completo del mes
        $year = Carbon::now()->format('Y');

        // TURNOS:
        $turnos = Turnos::where('idUser', $user->id)
            ->where('month', $month)
            ->where('day', $numerohoy)
            ->where('active', '1')
            ->get();

        $index = count($turnos);
        $clientesHoy = [];

        // CLIENTES
        for($i=0; $i<$index; $i++){
            $cliente = Cliente::where('id', $turnos[$i]->idCliente)->get();
            array_push($clientesHoy, $cliente[0]);
        }

        $data = [
            'turnos' => $turnos,
            'clientes' => $clientesHoy,
            'diahoy' => $diahoy,
            'numerohoy' => $numerohoy,
            'mes' => $month,
            'year' => $year
        ];

        return view('turnos.turnosHoy', $data);
    }



    public function disponible()
    {

        $user = Auth::user();

        $disponibilidad = Disponibilidad::where('idUser', $user->id)->get();

        $data = [];

        die('pendiente');
    }
}
