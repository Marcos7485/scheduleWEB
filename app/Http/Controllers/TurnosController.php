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
        $fechahoy = Carbon::now()->format('d/m/Y');
        $hoy = Carbon::now()->toDateString(); // Obtiene la fecha en formato 'YYYY-MM-DD'

        // Recuperar los turnos de hoy
        $turnos = Turnos::whereDate('fechahora', $hoy)
        ->where('idUser', $user->id)
        ->get();


        // Extraer la fecha y la hora de cada turno
        $turnos->transform(function ($turno) {
            // Convertir la cadena de fechahora en un objeto Carbon si aún no lo es
            $fecha = Carbon::parse($turno->fechahora)->toDateString(); // Obtener la fecha en formato 'YYYY-MM-DD'
            $hora = Carbon::parse($turno->fechahora)->format('H:i');  // Obtener la hora en formato 'HH:MM:SS'

            return [
                'id' => $turno->id,
                'idCliente' => $turno->idCliente,
                'idUser' => $turno->idUser,
                'fecha' => $fecha,
                'hora' => $hora,
                'status' => $turno->status, // Asegúrate de que 'status' sea un atributo válido en tu modelo
                'active' => $turno->active,
            ];
        });


        $index = count($turnos);

        $clientesHoy = [];

        // CLIENTES
        for ($i = 0; $i < $index; $i++) {
            $cliente = Cliente::where('id', $turnos[$i]['idCliente'])->get();
            array_push($clientesHoy, $cliente[0]);
        }

        $data = [
            'turnos' => $turnos,
            'clientes' => $clientesHoy,
            'diahoy' => $diahoy,
            'hoy' => $fechahoy
        ];

        return view('turnos.turnosHoy', $data);
    }


    public function TurnosWeek()
    {

        $user = Auth::user();
        // DATES:
        Carbon::setLocale('es');
        $diahoy = Carbon::now()->translatedFormat('l');  // 'l' representa el día completo de la semana
        // Obtener la fecha en formato 'DD-MM-YYYY'
        $hoy = Carbon::now()->format('d/m/Y');

        // Obtener el inicio y el final de la semana actual
        $inicioSemana = Carbon::now()->startOfWeek(Carbon::MONDAY); // Lunes de esta semana
        $finSemana = Carbon::now()->endOfWeek(Carbon::SUNDAY); // Domingo de esta semana

        // Recuperar los turnos de esta semana
        $turnos = Turnos::whereBetween('fechahora', [$inicioSemana, $finSemana])
        ->where('idUser', $user->id)
        ->get();

        $turnos->transform(function ($turno) {
            $fechaCarbon = Carbon::parse($turno->fechahora); // Convertir a objeto Carbon
            $fecha = $fechaCarbon->toDateString(); // Obtener la fecha en formato 'YYYY-MM-DD'
            $hora = $fechaCarbon->format('H:i'); // Obtener la hora en formato 'HH:MM'

            // $nombreDia = $fechaCarbon->dayName; Obtener el nombre completo del día (por ejemplo, "Monday")
            // $nombreDiaAbreviado = $fechaCarbon->shortDayName; Obtener el nombre abreviado del día (por ejemplo, "Mon")

            return [
                'id' => $turno->id,
                'idCliente' => $turno->idCliente,
                'idUser' => $turno->idUser,
                'dianame' => $fechaCarbon->dayName,
                'fecha' => $fecha,
                'hora' => $hora,
                'status' => $turno->status, // Asegúrate de que 'status' sea un atributo válido en tu modelo
                'active' => $turno->active,
            ];
        });


        $index = count($turnos);

        $clientesWeek = [];

        // CLIENTES
        for ($i = 0; $i < $index; $i++) {
            $cliente = Cliente::where('id', $turnos[$i]['idCliente'])->get();
            array_push($clientesWeek, $cliente[0]);
        }

        $data = [
            'turnos' => $turnos,
            'clientes' => $clientesWeek,
            'diahoy' => $diahoy,
            'hoy' => $hoy
        ];

        return view('turnos.turnosWeek', $data);
    }


    public function TurnosMonth()
    {
        $user = Auth::user();
        // DATES:
        Carbon::setLocale('es');
        $diahoy = Carbon::now()->translatedFormat('l');  // 'l' representa el día completo de la semana
        // Obtener la fecha en formato 'DD-MM-YYYY'
        $hoy = Carbon::now()->format('d/m/Y');

        // Obtener el inicio y el final del mes actual
        $inicioMes = Carbon::now()->startOfMonth(); // Primer día del mes actual
        $finMes = Carbon::now()->endOfMonth(); // Último día del mes actual

        // Recuperar los turnos de esta semana
        $turnos = Turnos::whereBetween('fechahora', [$inicioMes, $finMes])
            ->where('idUser', $user->id)
            ->get();


        $turnos->transform(function ($turno) {
            $fechaCarbon = Carbon::parse($turno->fechahora); // Convertir a objeto Carbon
            $fecha = $fechaCarbon->toDateString(); // Obtener la fecha en formato 'YYYY-MM-DD'
            $hora = $fechaCarbon->format('H:i'); // Obtener la hora en formato 'HH:MM'

            // $nombreDia = $fechaCarbon->dayName; Obtener el nombre completo del día (por ejemplo, "Monday")
            // $nombreDiaAbreviado = $fechaCarbon->shortDayName; Obtener el nombre abreviado del día (por ejemplo, "Mon")

            return [
                'id' => $turno->id,
                'idCliente' => $turno->idCliente,
                'idUser' => $turno->idUser,
                'dianame' => $fechaCarbon->dayName,
                'fecha' => $fecha,
                'hora' => $hora,
                'status' => $turno->status, // Asegúrate de que 'status' sea un atributo válido en tu modelo
                'active' => $turno->active,
            ];
        });


        $index = count($turnos);

        $clientesWeek = [];

        // CLIENTES
        for ($i = 0; $i < $index; $i++) {
            $cliente = Cliente::where('id', $turnos[$i]['idCliente'])->get();
            array_push($clientesWeek, $cliente[0]);
        }

        $data = [
            'turnos' => $turnos,
            'clientes' => $clientesWeek,
            'diahoy' => $diahoy,
            'hoy' => $hoy
        ];

        return view('turnos.turnosMonth', $data);
    }



    public function All()
    {

        $user = Auth::user();
        // DATES:
        Carbon::setLocale('es');
        $diahoy = Carbon::now()->translatedFormat('l');  // 'l' representa el día completo de la semana
        // Obtener la fecha en formato 'DD-MM-YYYY'
        $hoy = Carbon::now()->format('d/m/Y');

        // Recuperar los turnos de esta semana
        $turnos = Turnos::where('idUser', $user->id)->get();

        $turnos->transform(function ($turno) {
            $fechaCarbon = Carbon::parse($turno->fechahora); // Convertir a objeto Carbon
            $fecha = $fechaCarbon->toDateString(); // Obtener la fecha en formato 'YYYY-MM-DD'
            $hora = $fechaCarbon->format('H:i'); // Obtener la hora en formato 'HH:MM'

            // $nombreDia = $fechaCarbon->dayName; Obtener el nombre completo del día (por ejemplo, "Monday")
            // $nombreDiaAbreviado = $fechaCarbon->shortDayName; Obtener el nombre abreviado del día (por ejemplo, "Mon")

            return [
                'id' => $turno->id,
                'idCliente' => $turno->idCliente,
                'idUser' => $turno->idUser,
                'dianame' => $fechaCarbon->dayName,
                'fecha' => $fecha,
                'hora' => $hora,
                'status' => $turno->status, // Asegúrate de que 'status' sea un atributo válido en tu modelo
                'active' => $turno->active,
            ];
        });


        $index = count($turnos);

        $clientesWeek = [];

        // CLIENTES
        for ($i = 0; $i < $index; $i++) {
            $cliente = Cliente::where('id', $turnos[$i]['idCliente'])->get();
            array_push($clientesWeek, $cliente[0]);
        }

        $data = [
            'turnos' => $turnos,
            'clientes' => $clientesWeek,
            'diahoy' => $diahoy,
            'hoy' => $hoy
        ];

        return view('turnos.turnosAll', $data);
    }




    public function disponible()
    {

        $user = Auth::user();

        $disponibilidad = Disponibilidad::where('idUser', $user->id)->get();

        $data = [];

        die('pendiente');
    }


    public function create()
    {

        $input = '2024-06-24 16:00:00';
        // Datos para crear un nuevo turno
        $idUser = 1;
        $idCliente = 1;
        $fechahora = Carbon::parse($input); // Convertir la fecha usando Carbon 
        $active = 1;

        // Crear el turno
        $turno = new Turnos();
        $turno->idUser = $idUser;
        $turno->idCliente = $idCliente;
        $turno->fechahora = $fechahora;
        $turno->status = 'PENDIENTE';
        $turno->active = $active;
        $turno->save();
    }
}
