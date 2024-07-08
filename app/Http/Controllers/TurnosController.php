<?php

namespace App\Http\Controllers;

use App\Models\GlobalHash;
use App\Models\Turnos;
use App\Models\TurnosHash;
use App\Models\User;
use App\Services\ClienteSrv;
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


        if (!$turnosHoy->isEmpty()) {
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
        if (!$turnosSemana->isEmpty()) {
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
        if (!$turnosSemanaProx->isEmpty()) {
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
        if (!$turnosMes->isEmpty()) {
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

        if (!$turnosTodos->isEmpty()) {
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
        $verif = $this->TurnosSrv->TurnoHashInfo($token);

        $turnoHash = TurnosHash::where('hash', $token)->first();
        $GlobalTokenActivoVerif = $this->TurnosSrv->GlobalHashInfo($token);

        if ($verif === null) {
            if ($GlobalTokenActivoVerif !== null) {

                $user = User::where('id', $GlobalTokenActivoVerif->idUser)->first();
                $nombreUser = $user->name;
                $idUser = $user->id;
                $data = [
                    'menu' => false,
                    'usuarioNombre' => $nombreUser,
                    'usuarioId' => $idUser,
                    'message' => '',
                    'token' => $GlobalTokenActivoVerif->hash,
                    'lapsos' => $GlobalTokenActivoVerif->lapso
                ];
                return view('turnos.crearTurno', $data);
            } else {
                $data = [
                    'menu' => false
                ];
                return view('turnos.linkCaducado', $data);
            }
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
        $Disponibilidad = $this->DispSrv->DUsuarioId($user->id);
        return $this->TurnosSrv->TurnosDisponibles($user->id, $request->query('fecha'), $Disponibilidad->lapsos);
    }


    public function getHorariosDisponiblesCliente(Request $request)
    {
        $turnoHashID = $this->TurnosSrv->TurnoHashInfo($request->query('token'));
        if ($turnoHashID === null) {
            $turnoHashID = $this->TurnosSrv->GlobalHashInfo($request->query('token'));
        }
        return $this->TurnosSrv->TurnosDisponibles($request->query('usp'), $request->query('fecha'), $turnoHashID->lapso);
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
        $GlobalTokenActivoVerif = $this->TurnosSrv->GlobalHashInfo($token);


        if ($tokenActivoVerif === null) {
            if ($GlobalTokenActivoVerif !== null) {

                $fechaHora = Carbon::parse($fechaHoraString);

                $verificador = $this->TurnosSrv->VerificadorDisponibilidad($user, $fechaHoraString);

                if (!$verificador) {

                    $Cliente = $this->ClienteSrv->RegistrarCliente($request->telefono, $request->name);
                    $this->TurnosSrv->TurnosSave($user, $Cliente->id, $lapsos, $fechaHora);

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
                        'token' => $token,
                        'lapsos' => $lapsos,
                        'message' => "El turno seleccionado no se encuentra disponible"
                    ];

                    return view('turnos.crearTurno', $data);
                }
            } else {
                $data = [
                    'menu' => false,
                ];

                return view('turnos.linkCaducado', $data);
            }
        } else {

            $fechaHora = Carbon::parse($fechaHoraString);

            $verificador = $this->TurnosSrv->VerificadorDisponibilidad($user, $fechaHoraString);

            if (!$verificador) {

                $Cliente = $this->ClienteSrv->RegistrarCliente($request->telefono, $request->name);
                $this->TurnosSrv->TurnosSave($user, $Cliente->id, $lapsos, $fechaHora);
                $this->TurnosSrv->TurnoHashUpdate($user, $Cliente->id, $fechaHora, $token);

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
                    'token' => $token,
                    'lapsos' => $lapsos,
                    'message' => "El turno seleccionado no se encuentra disponible"
                ];

                return view('turnos.crearTurno', $data);
            }
        }
    }

    public function geralLink()
    {

        $user = Auth::user();
        $linkHash = GlobalHash::where('idUser', $user->id)->first();
        $link = route('registrar-turno', ['token' => $linkHash->hash]);

        $data = [
            'link' => $link,
            'lapsos' => $linkHash->lapso
        ];

        return view('turnos.globalHash', $data);
    }
}
