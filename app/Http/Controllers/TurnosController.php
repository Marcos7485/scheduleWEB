<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Disponibilidad;
use App\Models\Turnos;
use App\Models\TurnosHash;
use App\Models\User;
use App\Services\DispSrv;
use App\Services\TurnosSrv;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TurnosController extends Controller
{

    protected $DispSrv;
    protected $TurnosSrv;
    protected $ClienteSrv;

    public function __construct(DispSrv $DispSrv, TurnosSrv $TurnosSrv, ClienteSrv $ClienteSrv)
    {
        $this->DispSrv = $DispSrv;
        $this->TurnosSrv = $TurnosSrv;
        $this->ClienteSrv = $ClienteSrv;
    }


    public function TurnosHoy()
    {
        $user = Auth::user();
        $turnosHoy = $this->TurnosSrv->TurnosHoy($user->id); // Turnos de Hoy
        $this->TurnosSrv->FinalizarTurnosUser($user->id); // Finalizar turnos viejos
        if (!empty($turnosHoy)) {
            $data = [
                'turnos' => $this->TurnosSrv->TransformTurnos($turnosHoy),
                'periodo' => 'hoy'
            ];
            return view('turnos.turnosList', $data);
        } else {
            $data = ['message' => 'No hay turnos agendados'];
            return view('turnos.turnosList', $data);
        }
    }


    public function TurnosWeek()
    {
        $user = Auth::user();
        $turnosSemana = $this->TurnosSrv->TurnosDeSemana($user->id); // turnos de la semana
        $this->TurnosSrv->FinalizarTurnosUser($user->id); // Finalizar turnos viejos
        if (!empty($turnosSemana)) {
            $data = [
                'turnos' => $this->TurnosSrv->TransformTurnos($turnosSemana),
                'periodo' => 'de esta semana'
            ];
            return view('turnos.turnosList', $data);
        } else {
            $data = ['message' => 'No hay turnos agendados'];
            return view('turnos.turnosList', $data);
        }
    }


    public function TurnosNextWeek()
    {
        $user = Auth::user();
        $turnosSemanaProx = $this->TurnosSrv->TurnosNextWeek($user->id);
        $this->TurnosSrv->FinalizarTurnosUser($user->id);
        if (!empty($turnosSemanaProx)) {
            $data = [
                'turnos' => $this->TurnosSrv->TransformTurnos($turnosSemanaProx),
                'periodo' => 'de la semana proxima'
            ];
            return view('turnos.turnosList', $data);
        } else {
            $data = ['message' => 'No hay turnos agendados'];
            return view('turnos.turnosList', $data);
        }
    }


    public function TurnosMonth()
    {
        $user = Auth::user();
        $turnosMes = $this->TurnosSrv->TurnosMes($user->id);
        $this->TurnosSrv->FinalizarTurnosUser($user->id);
        if (!empty($turnosMes)) {
            $data = [
                'turnos' => $this->TurnosSrv->TransformTurnos($turnosMes),
                'periodo' => 'del mes'
            ];
            return view('turnos.turnosList', $data);
        } else {
            $data = ['message' => 'No hay turnos agendados'];
            return view('turnos.turnosList', $data);
        }
    }


    public function TurnosAll()
    {
        $user = Auth::user();
        $turnosTodos = $this->TurnosSrv->TurnosAll($user->id);
        $this->TurnosSrv->FinalizarTurnosUser($user->id);
        if (!empty($turnosTodos)) {
            $data = [
                'turnos' => $this->TurnosSrv->TransformTurnos($turnosTodos),
                'periodo' => 'agendados'
            ];
            return view('turnos.turnosList', $data);
        } else {
            $data = ['message' => 'No hay turnos agendados'];
            return view('turnos.turnosList', $data);
        }
    }


    public function darTurnos()
    {
        $user = Auth::user();
        $Disponibilidad = $this->DispSrv->DUsuarioId($user->id);
        $link = '---------------';
        $data = [
            'link' => $link,
            'lapsos' => $Disponibilidad->lapsos
        ];
        return view('turnos.darTurnos', $data);
    }


    public function generateTurnosHash()
    {
        $user = Auth::user();
        $Disponibilidad = $this->DispSrv->DUsuarioId($user->id);
        $this->TurnosSrv->TurnosHashCleanOld(); // Borrar hash viejos
        $hash = $this->TurnosSrv->TurnosHashGen();
        $link = route('registrar-turno', ['token' => $hash]);
        $data = [
            'idUser' => $user->id,
            'hash' => $hash,
            'lapso' => $Disponibilidad->lapsos,
            'active' => 1
        ];
        $this->TurnosSrv->TurnoHashSave($data);
        return response()->json(['link' => $link]);
    }


    public function registrarTurno($token)
    {
        $verif = $this->TurnosSrv->TurnoHashInfo($token); // verifica si existe y sigue activo
        $turnoHash = TurnosHash::where('hash', $token)->first(); // obtiene la informacion del hash

        if ($verif->isEmpty()) {
            $data = [
                'menu' => false
            ];
            return view('turnos.linkCaducado', $data);
        } else {
            $user = User::where('id', $turnoHash->idUser)->first();
            $nombreUser = $user->name;
            $idUser = $user->id;
            $data = [
                'menu' => false,
                'usuarioNombre' => $nombreUser,
                'usuarioId' => $idUser,
                'message' => '',
                'token' => $token,
                'lapsos' => $turnoHash->lapso
            ];
            return view('turnos.crearTurno', $data);
        }
    }


    public function crearTurnos()
    {
        $user = Auth::user();
        $Disponibilidad = $this->DispSrv->DUsuarioId($user->id);
        $data = [
            'message' => "",
            'lapsos' => $Disponibilidad->lapsos
        ];
        return view('turnos.turnosForm', $data);
    }


    public function getHorariosDisponibles(Request $request)
    {
        $user = Auth::user();
        $lapsos = $this->DispSrv->LapsosDisponibles($user->id, $request->query('fecha'));
        $ocupado = $this->TurnosSrv->TurnosOcupados($user->id,$request->query('fecha'));

        $Disponibilidad = $this->DispSrv->DUsuarioId($user->id);
        $lapsosTime = $Disponibilidad->lapsos;

        return $this->DispSrv->HorariosDisponibles($lapsos, $ocupado, $lapsosTime);
    }


    public function getHorariosDisponiblesCliente(Request $request)
    {
        $userId = $request->query('usp');
        $fecha = $request->query('fecha');

        $turnoHashID = $this->TurnosSrv->TurnoHashInfo($request->query('token'));

        $lapsos = $this->DispSrv->LapsosDisponibles($userId, $fecha);
        $ocupado = $this->TurnosSrv->TurnosOcupados($userId, $fecha);

        $lapsosDisponibles = array_diff($lapsos, $ocupado);
        $lapsosDisponibles = array_values($lapsosDisponibles);

        $lapsosTime = $turnoHashID->lapso;
        
        return $this->DispSrv->HorariosDisponibles($lapsos, $ocupado, $lapsosTime);
    }




    public function create(Request $request)
    {
        $user = Auth::user();
        $Disponibilidad = $this->DispSrv->DUsuarioId($user->id);
        $lapsos = $Disponibilidad->lapsos;

        $fechaHoraString = $request->fecha . ' ' . $request->horario . ':00';
        $fechaHora = Carbon::parse($fechaHoraString);

        $verificador = Turnos::where('fechahora', $fechaHora)
            ->where('idUser', $user->id)
            ->get();

        if ($verificador->isEmpty()) {
            $cliente = $this->ClienteSrv->RegistrarCliente($request->telefono, $request->name);
            $this->TurnosSrv->TurnosSave($user->id, $cliente->id, $lapsos, $fechaHora);

            $data = [
                'lapsos' => $lapsos
            ];

            return view('turnos.turnoAgendado', $data);
        } else {
            $data = [
                'message' => "Ese turno ya no se encuentra disponible"
            ];

            return view('turnos.turnosForm', $data);
        }
    }


    public function createTurnoCliente(Request $request)
    {
        $user = $request->usId;
        $token = $request->token;
        $lapsos = $request->lapsos;

        $fechaHoraString = $request->fecha . ' ' . $request->horario . ':00';

        $userDate = User::where('id', $user)->get();
        $userName = $userDate[0]->name;

        $tokenActivoVerif = $this->TurnosSrv->TurnoHashInfo($token);

        if ($tokenActivoVerif->isEmpty()) {
            $data = [
                'menu' => false,
            ];

            return view('turnos.linkCaducado', $data);

        } else {

            $turno = new Turnos();
            $fechaHora = Carbon::parse($fechaHoraString);

            $verificador = $this->DispSrv->VerificadorDisponibilidad($request->usId, $request->fecha, $tokenActivoVerif->lapso, $fechaHoraString);

            if (!$verificador) {

                $Cliente = $this->ClienteSrv->RegistrarCliente($request->telefono, $request->name);
                $this->TurnosSrv->TurnosSave($user, $Cliente->id, $lapsos, $fechaHora);

                $TurnoInfo = Turnos::where('fechahora', $fechaHora)
                    ->where('idCliente', $Cliente->id)
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
                    'fecha' => $request->fecha,
                    'horario' => $request->horario,
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
