<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Turnos;
use App\Models\TurnosHash;
use App\Models\User;
use App\Services\DispSrv;
use Carbon\Carbon;

class TurnosSrv
{

    protected $DispSrv;

    public function __construct(DispSrv $DispSrv)
    {
        $this->DispSrv = $DispSrv;
    }

    public function TurnosSave($idUser ,$idCliente, $lapso, $fechaHora){
        $turno = new Turnos();

        if ($lapso == '30') {
            $finalizacion = $fechaHora->copy()->addMinutes(30);
        } elseif ($lapso == '60') {
            $finalizacion = $fechaHora->copy()->addMinutes(60);
        } elseif ($lapso == '120') {
            $finalizacion = $fechaHora->copy()->addMinutes(120);
        }

        $turno->idCliente = $idCliente;
        $turno->idUser = $idUser;
        $turno->fechahora = $fechaHora;
        $turno->finalizacion = $finalizacion;
        $turno->status = 'PENDIENTE';
        $turno->active = 1;
        $turno->save();
    }

    public function TurnosAll($id)
    {
        return Turnos::where('idUser', $id)->get();
    }

    public function TurnosHoy($id)
    {
        $dates = $this->DispSrv->Dates();
        return Turnos::whereDate('fechahora', $dates['hoy'])->where('idUser', $id)->get();
    }

    public function TurnosDeSemana($id)
    {
        $dates = $this->DispSrv->Dates();
        return Turnos::whereBetween('fechahora', [$dates['inicioSemana'], $dates['finSemana']])->where('idUser', $id)->get();
    }

    public function TurnosNextWeek($id)
    {
        $dates = $this->DispSrv->Dates();
        return Turnos::whereBetween('fechahora', [$dates['inicioSemanaProx'], $dates['finSemanaProx']])->where('idUser', $id)->get();
    }

    public function TurnosMes($id)
    {
        $dates = $this->DispSrv->Dates();
        return Turnos::whereBetween('fechahora', [$dates['inicioMes'], $dates['finMes']])->where('idUser', $id)->get();
    }

    public function FinalizarTurnosUser($id)
    {
        $dates = $this->DispSrv->Dates();

        $turnos = Turnos::whereDate('fechahora', $dates['hoy'])
            ->where('idUser', $id)
            ->get();

        foreach ($turnos as $turno) {
            if ($turno->fechahora < $dates['datetimenow']) {
                $turno->active = 0;
                $turno->status = 'FINALIZADO';
                $turno->save();
            }
        }
    }

    public function TransformTurnos($turnos)
    {

        $index = count($turnos); // Obtener el número de elementos en $turnos

        $turnosResult = []; // Inicializar un nuevo arreglo para almacenar los turnos transformados

        // Recorrer cada turno en el arreglo $turnos
        for ($i = 0; $i < $index; $i++) {
            // Parsear las fechas y horas utilizando Carbon
            $fecha = Carbon::parse($turnos[$i]->fechahora)->format('d/m');
            $hora = Carbon::parse($turnos[$i]->fechahora)->format('H:i');
            $finalizacion = Carbon::parse($turnos[$i]->finalizacion)->format('H:i');

            // Obtener el cliente y usuario asociados a este turno
            $cliente = Cliente::where('id', $turnos[$i]['idCliente'])->first();
            $user = User::where('id', $turnos[$i]->idUser)->first();

            // Construir el arreglo de sesión (sesion)
            $sesion = [
                'id' => $turnos[$i]->id,
                'cliente' => $cliente,
                'usuario' => $user,
                'fecha' => $fecha,
                'hora' => $hora,
                'final' => $finalizacion,
                'status' => $turnos[$i]->status,
                'active' => $turnos[$i]->active,
            ];

            // Agregar el arreglo de sesión al arreglo $turnosResult
            array_push($turnosResult, $sesion);
        }

        // Devolver el arreglo transformado $turnosResult
        return $turnosResult;
    }

    public function TurnosHashGen()
    {
        $randomBytes = random_bytes(32);
        $randomString = bin2hex($randomBytes);
        return hash('ripemd160', $randomString);
    }

    public function TurnosHashCleanOld()
    {
        $dates = $this->DispSrv->Dates();
        $TurnosViejos = TurnosHash::whereDate('created_at', '<=', $dates['subTwoDays'])->where('active', 1)->get();
        foreach ($TurnosViejos as $turnos) {
            $turnos->delete();
        }
    }

    public function TurnoHashSave($data)
    {
        $turnosHash = new TurnosHash();
        $turnosHash->idUser = $data['idUser'];
        $turnosHash->hash = $data['hash'];
        $turnosHash->lapso = $data['lapso'];
        $turnosHash->active = $data['active'];
        $turnosHash->save();
    }

    public function TurnoHashInfo($token)
    {
        return TurnosHash::where('hash', $token)->where('active', 1)->first();
    }

    public function TurnoHashUpdate($idUser, $idCliente, $fechaHora, $token){
        
        $TurnoInfo = Turnos::where('fechahora', $fechaHora)
        ->where('idCliente', $idCliente)
        ->where('idUser', $idUser)
        ->where('active', 1)
        ->get();


    TurnosHash::updateOrCreate(
        ['hash' => $token], // Condición para encontrar el registro existente
        [
            'active' => 0,
            'idTurno' => $TurnoInfo[0]->id
        ]
    );
    }

    public function TurnosOcupados($idUser, $fecha)
    {
        Carbon::setLocale('es');
        $fechaCarbon = Carbon::parse($fecha);
        $turnosOcupados = Turnos::whereDate('fechahora', $fechaCarbon->toDateString())
            ->where('idUser', $idUser)
            ->get();

        $ocupado = [];

        for ($i = 0; $i < count($turnosOcupados); $i++) {
            $a = Carbon::parse($turnosOcupados[$i]->fechahora);
            $b = Carbon::parse($turnosOcupados[$i]->finalizacion);

            while ($a < $b) {
                array_push($ocupado, $a->format('H:i'));
                $a->addMinutes(30);
            }
        }
        return $ocupado;
    }
}
