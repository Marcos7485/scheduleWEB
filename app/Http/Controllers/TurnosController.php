<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Disponibilidad;
use App\Models\Turnos;
use App\Models\TurnosHash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isNull;

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

        $fechayhoraActual = Carbon::now();
        foreach ($turnos as $turno) {
            if ($turno->fechahora < $fechayhoraActual) {
                $turno->active = 0;
                $turno->status = 'FINALIZADO';
                $turno->save();
            }
        }

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

        $fechayhoraActual = Carbon::now();
        foreach ($turnos as $turno) {
            if ($turno->fechahora < $fechayhoraActual) {
                $turno->active = 0;
                $turno->status = 'FINALIZADO';
                $turno->save();
            }
        }
        
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


    public function darTurnos()
    {

        $link = '---------------';

        $data = ['link' => $link];

        return view('turnos.darTurnos', $data);
    }

    public function generateTurnosHash(Request $request)
    {

        $Turnoshash = new TurnosHash();
        $user = Auth::user();

        $fechaLimite = Carbon::now()->subDays(2)->toDateString();


        // /////////////////Eliminar Registros viejos activos//////////

        $TurnosViejos = TurnosHash::whereDate('created_at', '<=', $fechaLimite)->get();
        foreach ($TurnosViejos as $turnos) {
            $turnos->delete();
        }

        // /////////////////HASH////////////////////////////////////////////

        $randomBytes = random_bytes(32);
        $randomString = bin2hex($randomBytes);
        $hash = hash('ripemd160', $randomString);
        $link = route('registrar-turno', ['token' => $hash]);

        // ////////////////SAVEHASH/////////////////////////////////////////

        $Turnoshash->idUser = $user->id;
        $Turnoshash->hash = $hash;
        $Turnoshash->active = 1;
        $Turnoshash->save();

        // ////////////////////////////////////////////////////////////

        return response()->json(['link' => $link]);
    }


    public function registrarTurno($token)
    {

        $Turno = TurnosHash::where('hash', $token)
            ->where('active', 1)
            ->get();

        if ($Turno->isEmpty()) {
            $data = [
                'menu' => false
            ];
            return view('turnos.linkCaducado', $data);
        } else {

            $user = User::where('id', $Turno[0]->idUser)->get();

            $nombreUser = $user[0]->name;
            $idUser = $user[0]->id;

            $data = [
                'menu' => false,
                'usuarioNombre' => $nombreUser,
                'usuarioId' => $idUser,
                'message' => '',
                'token' => $token
            ];

            return view('turnos.crearTurno', $data);
        }
    }



    public function crearTurnos()
    {
        $data = [
            'message' => ""
        ];

        return view('turnos.turnosForm', $data);
    }

    public function getHorariosDisponibles(Request $request)
    {
        Carbon::setLocale('es');
        $user = Auth::user();
        $fecha = $request->query('fecha');

        $fechaCarbon = Carbon::parse($fecha);
        $nombreDiaSemana = $fechaCarbon->isoFormat('dddd');

        // Array de reemplazo para quitar acentos
        $acentos = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];

        // Remover acentos del nombre del día de la semana
        $nombreDiaSinAcentos = str_replace($acentos, $sinAcentos, $nombreDiaSemana);


        $Disponibilidad = Disponibilidad::where('idUser', $user->id)->get();
        $horarioDelDia = $Disponibilidad[0]->$nombreDiaSinAcentos;


        $horariosDisponibles = json_decode($horarioDelDia);


        $horainicio = Carbon::parse($horariosDisponibles[0] . ":" . $horariosDisponibles[1]);
        $horafin = Carbon::parse($horariosDisponibles[2] . ":" . $horariosDisponibles[3]);

        $lapsos = [];

        $horaActual = $horainicio;

        while ($horaActual < $horafin) {
            $lapsos[] = $horaActual->format('H:i');
            $horaActual->addMinutes(30);
        }

        $turnosOcupados = Turnos::whereDate('fechahora', $fechaCarbon->toDateString())
            ->where('idUser', $user->id)
            ->get();

        $index = count($turnosOcupados);
        $ocupado = [];

        for ($i = 0; $i < $index; $i++) {
            $a = Carbon::parse($turnosOcupados[$i]->fechahora);

            array_push($ocupado, $a->format('H:i'));
        }

        $lapsosDisponibles = array_diff($lapsos, $ocupado);
        $lapsosDisponibles = array_values($lapsosDisponibles);

        return response()->json($lapsosDisponibles);
    }


    public function getHorariosDisponiblesCliente(Request $request)
    {
        Carbon::setLocale('es');
        $userId = $request->query('usp');
        $fecha = $request->query('fecha');

        $fechaCarbon = Carbon::parse($fecha);
        $nombreDiaSemana = $fechaCarbon->isoFormat('dddd');

        // Array de reemplazo para quitar acentos
        $acentos = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];

        // Remover acentos del nombre del día de la semana
        $nombreDiaSinAcentos = str_replace($acentos, $sinAcentos, $nombreDiaSemana);


        $Disponibilidad = Disponibilidad::where('idUser', $userId)->get();
        $horarioDelDia = $Disponibilidad[0]->$nombreDiaSinAcentos;


        $horariosDisponibles = json_decode($horarioDelDia);


        $horainicio = Carbon::parse($horariosDisponibles[0] . ":" . $horariosDisponibles[1]);
        $horafin = Carbon::parse($horariosDisponibles[2] . ":" . $horariosDisponibles[3]);

        $lapsos = [];

        $horaActual = $horainicio;

        while ($horaActual < $horafin) {
            $lapsos[] = $horaActual->format('H:i');
            $horaActual->addMinutes(30);
        }

        $turnosOcupados = Turnos::whereDate('fechahora', $fechaCarbon->toDateString())
            ->where('idUser', $userId)
            ->get();

        $index = count($turnosOcupados);
        $ocupado = [];

        for ($i = 0; $i < $index; $i++) {
            $a = Carbon::parse($turnosOcupados[$i]->fechahora);

            array_push($ocupado, $a->format('H:i'));
        }

        $lapsosDisponibles = array_diff($lapsos, $ocupado);
        $lapsosDisponibles = array_values($lapsosDisponibles);

        return response()->json($lapsosDisponibles);
    }

    public function create(Request $request)
    {

        $user = Auth::user();
        $turno = new Turnos();

        $fecha = $request->fecha;
        $horario = $request->horario;

        $fechaHoraString = $fecha . ' ' . $horario . ':00';

        // Usa Carbon para crear una instancia de fecha y hora y formatearla correctamente
        $fechaHora = Carbon::parse($fechaHoraString);

        $verificador = Turnos::where('fechahora', $fechaHora)
            ->where('idUser', $user->id)
            ->get();

        if ($verificador->isEmpty()) {

            $telefono = $request->telefono;

            $exist = Cliente::where('telefono', $telefono)->get();

            if ($exist->isEmpty()) {
                // No hay resultados que coincidan con el teléfono proporcionado
                $cliente = new Cliente;
                $cliente->nombre = $request->name;
                $cliente->telefono = $telefono;
                $cliente->frequency = 1;
                $cliente->save();
            } else {
                // Hay resultados que coinciden con el teléfono proporcionado
                $exist[0]->frequency = $exist[0]->frequency + 1;
                $exist[0]->save();
            }


            $persona = Cliente::where('telefono', $telefono)->get();



            $turno->idCliente = $persona[0]->id;
            $turno->idUser = $user->id;
            $turno->fechahora = $fechaHora;
            $turno->status = 'PENDIENTE';
            $turno->active = 1;
            $turno->save();


            $data = [
                'message' => "Turno guardado exitosamente"
            ];

            return view('turnos.turnosForm', $data);
        } else {

            $data = [
                'message' => "Ese turno ya fue agendado anteriormente"
            ];

            return view('turnos.turnosForm', $data);
        }
    }

    public function createTurnoCliente(Request $request)
    {

        $user = $request->usId;
        $token = $request->token;
        $userDate = User::where('id', $user)->get();
        $userName = $userDate[0]->name;

        $tokenActivoVerif = TurnosHash::where('hash', $token)
            ->where('active', 1)
            ->get();

        if ($tokenActivoVerif->isEmpty()) {
            $data = [
                'menu' => false,
            ];

            return view('turnos.linkCaducado', $data);
        } else {

            $turno = new Turnos();

            $fecha = $request->fecha;
            $horario = $request->horario;

            $fechaHoraString = $fecha . ' ' . $horario . ':00';

            // Usa Carbon para crear una instancia de fecha y hora y formatearla correctamente
            $fechaHora = Carbon::parse($fechaHoraString);

            $verificador = Turnos::where('fechahora', $fechaHora)
                ->where('idUser', $user)
                ->get();

            if ($verificador->isEmpty()) {

                $telefono = $request->telefono;

                $exist = Cliente::where('telefono', $telefono)->get();

                if ($exist->isEmpty()) {
                    // No hay resultados que coincidan con el teléfono proporcionado
                    $cliente = new Cliente;
                    $cliente->nombre = $request->name;
                    $cliente->telefono = $telefono;
                    $cliente->frequency = 1;
                    $cliente->save();
                } else {
                    // Hay resultados que coinciden con el teléfono proporcionado
                    $exist[0]->frequency = $exist[0]->frequency + 1;
                    $exist[0]->save();
                }


                $persona = Cliente::where('telefono', $telefono)->get();



                $turno->idCliente = $persona[0]->id;
                $turno->idUser = $user;
                $turno->fechahora = $fechaHora;
                $turno->status = 'PENDIENTE';
                $turno->active = 1;
                $turno->save();

                $TurnoInfo = Turnos::where('fechahora', $fechaHora)
                    ->where('idCliente', $persona[0]->id)
                    ->where('idUser', $user)
                    ->where('active', 1)
                    ->get();


                TurnosHash::updateOrCreate(
                    ['hash' => $token], // Condición para encontrar el registro existente
                    [
                        'active' => 0,
                        'idTurno' => $TurnoInfo[0]->id
                    ]
                );

                $data = [
                    'fecha' => $fecha,
                    'horario' => $horario,
                    'cliente' => $request->name,
                    'userName' => $userName,
                    'menu' => false
                ];

                return view('turnos.turnoConfirmation', $data);
            } else {

                $data = [
                    'menu' => false,
                    'usuarioNombre' => $userName,
                    'usuarioId' => $user,
                    'message' => "El turno seleccionado no se encuentra disponible"
                ];

                return view('turnos.crearTurno', $data);
            }
        }
    }
}
