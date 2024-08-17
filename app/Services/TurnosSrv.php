<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\GlobalHash;
use App\Models\Trabajadores;
use App\Models\Turnos;
use App\Models\TurnosHash;
use App\Models\User;
use App\Services\DispSrv;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TurnosSrv
{

    protected $DispSrv;

    public function __construct(DispSrv $DispSrv)
    {
        $this->DispSrv = $DispSrv;
    }

    public function TurnosSave($idUser, $idCliente, $lapso, $fechaHora)
    {
        $turno = new Turnos();

        if ($lapso == '30') {
            $finalizacion = $fechaHora->copy()->addMinutes(30);
        } elseif ($lapso == '60') {
            $finalizacion = $fechaHora->copy()->addMinutes(60);
        } elseif ($lapso == '90') {
            $finalizacion = $fechaHora->copy()->addMinutes(90);
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

    public function TurnosSaveTrabajador($idTrabajador, $idCliente, $lapso, $fechaHora)
    {
        $turno = new Turnos();

        if ($lapso == '30') {
            $finalizacion = $fechaHora->copy()->addMinutes(30);
        } elseif ($lapso == '60') {
            $finalizacion = $fechaHora->copy()->addMinutes(60);
        } elseif ($lapso == '90') {
            $finalizacion = $fechaHora->copy()->addMinutes(90);
        } elseif ($lapso == '120') {
            $finalizacion = $fechaHora->copy()->addMinutes(120);
        }

        $turno->idCliente = $idCliente;
        $turno->idTrabajador = $idTrabajador;
        $turno->fechahora = $fechaHora;
        $turno->finalizacion = $finalizacion;
        $turno->status = 'PENDIENTE';
        $turno->active = 1;
        $turno->save();

        Trabajadores::where('id', $idTrabajador)
            ->where('active', 1)
            ->increment('selected');
    }

    public function TurnosAll($id)
    {
        return Turnos::where('idUser', $id)->orderBy('fechahora')->get();
    }

    public function TurnosAllEmpresa($id)
    {
        $trabajadores = Trabajadores::where('idEmpresa', $id)->where('active', 1)->get();
        // Extrae los IDs de los trabajadores
        $trabajadoresIds = $trabajadores->pluck('id')->toArray();

        $turnos = Turnos::whereIn('idTrabajador', $trabajadoresIds)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosAllRecycledEmpresa($id)
    {
        $trabajadores = Trabajadores::onlyTrashed()->where('idEmpresa', $id)->get();
        // Extrae los IDs de los trabajadores
        $trabajadoresIds = $trabajadores->pluck('id')->toArray();

        $turnos = Turnos::whereIn('idTrabajador', $trabajadoresIds)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosAllTrabajador($id)
    {
        $turnos = Turnos::where('idTrabajador', $id)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosHoy($id)
    {
        $dates = $this->DispSrv->Dates();
        return Turnos::whereDate('fechahora', $dates['hoy'])->where('idUser', $id)->orderBy('fechahora')->get();
    }

    public function TurnosHoyEmpresa($id)
    {
        $dates = $this->DispSrv->Dates();
        $trabajadores = Trabajadores::where('idEmpresa', $id)->where('active', 1)->get();
        // Extrae los IDs de los trabajadores
        $trabajadoresIds = $trabajadores->pluck('id')->toArray();
        $turnos = Turnos::whereDate('fechahora', $dates['hoy'])
            ->whereIn('idTrabajador', $trabajadoresIds)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosHoyTrabajador($id)
    {
        $dates = $this->DispSrv->Dates();
        $turnos = Turnos::whereDate('fechahora', $dates['hoy'])
            ->where('idTrabajador', $id)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosDeSemana($id)
    {
        $dates = $this->DispSrv->Dates();
        return Turnos::whereBetween('fechahora', [$dates['inicioSemana'], $dates['finSemana']])->where('idUser', $id)->orderBy('fechahora')->get();
    }

    public function TurnosDeSemanaEmpresa($id)
    {
        $dates = $this->DispSrv->Dates();
        $trabajadores = Trabajadores::where('idEmpresa', $id)->where('active', 1)->get();
        // Extrae los IDs de los trabajadores
        $trabajadoresIds = $trabajadores->pluck('id')->toArray();

        $turnos = Turnos::whereBetween('fechahora', [$dates['inicioSemana'], $dates['finSemana']])
            ->whereIn('idTrabajador', $trabajadoresIds)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosDeSemanaTrabajador($id)
    {
        $dates = $this->DispSrv->Dates();
        $turnos = Turnos::whereBetween('fechahora', [$dates['inicioSemana'], $dates['finSemana']])
            ->where('idTrabajador', $id)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosNextWeek($id)
    {
        $dates = $this->DispSrv->Dates();
        return Turnos::whereBetween('fechahora', [$dates['inicioSemanaProx'], $dates['finSemanaProx']])->where('idUser', $id)->orderBy('fechahora')->get();
    }

    public function TurnosNextWeekEmpresa($id)
    {
        $dates = $this->DispSrv->Dates();

        $trabajadores = Trabajadores::where('idEmpresa', $id)->where('active', 1)->get();
        // Extrae los IDs de los trabajadores
        $trabajadoresIds = $trabajadores->pluck('id')->toArray();

        $turnos = Turnos::whereBetween('fechahora', [$dates['inicioSemanaProx'], $dates['finSemanaProx']])
            ->whereIn('idTrabajador', $trabajadoresIds)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosNextWeekTrabajador($id)
    {
        $dates = $this->DispSrv->Dates();

        $turnos = Turnos::whereBetween('fechahora', [$dates['inicioSemanaProx'], $dates['finSemanaProx']])
            ->where('idTrabajador', $id)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosMes($id)
    {
        $dates = $this->DispSrv->Dates();
        return Turnos::whereBetween('fechahora', [$dates['inicioMes'], $dates['finMes']])->where('idUser', $id)->orderBy('fechahora')->get();
    }

    public function TurnosMesEmpresa($id)
    {
        $dates = $this->DispSrv->Dates();
        $trabajadores = Trabajadores::where('idEmpresa', $id)->where('active', 1)->get();
        // Extrae los IDs de los trabajadores
        $trabajadoresIds = $trabajadores->pluck('id')->toArray();

        $turnos = Turnos::whereBetween('fechahora', [$dates['inicioMes'], $dates['finMes']])
            ->whereIn('idTrabajador', $trabajadoresIds)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function TurnosMesTrabajador($id)
    {
        $dates = $this->DispSrv->Dates();
        $turnos = Turnos::whereBetween('fechahora', [$dates['inicioMes'], $dates['finMes']])
            ->where('idTrabajador', $id)
            ->orderBy('fechahora')
            ->get();

        return $turnos;
    }

    public function FinalizarTurnosUser($id)
    {
        $dates = $this->DispSrv->Dates();

        $turnos = Turnos::where('idUser', $id)->where('status', 'PENDIENTE')->get();

        foreach ($turnos as $turno) {
            if ($turno->fechahora < $dates['datetimenow']) {
                $turno->active = 0;
                $turno->status = 'FINALIZADO';
                $turno->save();
            }
        }
    }

    public function FinalizarTurnosEmpresa($id)
    { //editar
        $dates = $this->DispSrv->Dates();
        $trabajadores = Trabajadores::withTrashed()->where('idEmpresa', $id)
            ->get();

        $trabajadoresIds = $trabajadores->pluck('id')->toArray();

        // Obtén los turnos que coinciden con los IDs de los trabajadores
        $turnos = Turnos::whereIn('idTrabajador', $trabajadoresIds)
            ->where('fechahora', '<', $dates['datetimenow'])
            ->get();

        // Actualiza el estado de los turnos antiguos
        foreach ($turnos as $turno) {
            $turno->active = 0;
            $turno->status = 'FINALIZADO';
            $turno->save();
        }
    }

    public function TransformTurnos($turnos)
    {
        Carbon::setLocale('es'); // Configura Carbon para usar el español
        $index = count($turnos); // Obtener el número de elementos en $turnos

        $turnosResult = []; // Inicializar un nuevo arreglo para almacenar los turnos transformados

        // Recorrer cada turno en el arreglo $turnos
        for ($i = 0; $i < $index; $i++) {
            // Parsear las fechas y horas utilizando Carbon
            $fecha = Carbon::parse($turnos[$i]->fechahora)->format('d/m');
            $diaDeLaSemana = Carbon::parse($turnos[$i]->fechahora)->isoFormat('dddd');

            $hora = Carbon::parse($turnos[$i]->fechahora)->format('H:i');
            $finalizacion = Carbon::parse($turnos[$i]->finalizacion)->format('H:i');

            // Obtener el cliente y usuario asociados a este turno
            $cliente = Cliente::where('id', $turnos[$i]['idCliente'])->first();
            if ($turnos[$i]->idUser !== null) {
                $user = User::where('id', $turnos[$i]->idUser)->first();
            } else {
                $user = Trabajadores::withTrashed()->where('id', $turnos[$i]->idTrabajador)->first();
            }


            // Construir el arreglo de sesión (sesion)
            $sesion = [
                'id' => $turnos[$i]->id,
                'cliente' => $cliente,
                'usuario' => $user,
                'fecha' => $fecha,
                'diaDeLaSemana' => $diaDeLaSemana,
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

    public function GlobalHashInfo($token)
    {
        return GlobalHash::where('hash', $token)->where('active', 1)->first();
    }

    public function TurnoHashUpdate($idUser, $idCliente, $fechaHora, $token)
    {

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

    public function TurnosDisponibles($idUser, $fecha, $lapsoTurno)
    {
        Carbon::setLocale('es');
        $fechaCarbon = Carbon::parse($fecha);

        $nombreDiaSemana = $fechaCarbon->isoFormat('dddd');
        $acentos = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
        $nombreDiaSinAcentos = str_replace($acentos, $sinAcentos, $nombreDiaSemana);
        $Disponibilidad = $this->DispSrv->DUsuarioId($idUser);

        if (!$Disponibilidad) {
            Log::error("Disponibilidad no encontrada para el usuario ID: $idUser");
            return [];
        }

        $horarioDelDia = $Disponibilidad->$nombreDiaSinAcentos;
        $horariosDisponibles = json_decode($horarioDelDia);

        if (!$horariosDisponibles) {
            Log::error("Horarios no disponibles para el día: $nombreDiaSinAcentos");
            return [];
        }

        $horainicio = Carbon::parse($horariosDisponibles[0] . ":" . $horariosDisponibles[1]);
        $horafin = Carbon::parse($horariosDisponibles[2] . ":" . $horariosDisponibles[3]);

        $lapsos = [];

        if ($horainicio < $horafin) {
            while ($horainicio < $horafin) {
                $lapsos[] = $horainicio->format('H:i');
                $horainicio->addMinutes(30);
            }
        }


        if ($horafin->lt($horainicio)) {
            // Ajustar la hora de fin si es menor que la hora de inicio (cruza medianoche)
            if ($horafin->lt($horainicio)) {
                $horafin->addDay(); // Añadir un día para manejar el rango que cruza medianoche
            }

            $current = $horainicio->copy(); // Crear una copia de la hora de inicio para modificar

            while ($current->lt($horafin)) {
                $lapsos[] = $current->format('H:i');
                $current->addMinutes(30);
            }
        }


        if ($horainicio->eq($horafin)) {
            // Agregar el valor inicial
            $lapsos[] = $horainicio->format('H:i');

            // Agregar 30 minutos a la hora de inicio
            $horainicio->addMinutes(30);

            // Bucle para agregar lapsos cada 30 minutos
            while ($horainicio->lt($horafin->copy()->addDay())) {
                $lapsos[] = $horainicio->format('H:i');
                $horainicio->addMinutes(30);
            }
        }

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
        $lapsosDisponibles = array_diff($lapsos, $ocupado);
        $lapsosDisponibles = array_values($lapsosDisponibles);


        $disponible = [];
        $index = count($lapsosDisponibles);

        if ($lapsoTurno == '30') {
            $disponible = $lapsosDisponibles;
        } elseif ($lapsoTurno == '60') {

            for ($i = 0; $i < $index; $i++) {
                if (isset($lapsosDisponibles[$i + 1])) {
                    $hora1 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i]);
                    $hora2 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i + 1]);
                    $diferenciaEnMinutos = $hora1->diffInMinutes($hora2);
                    if ($diferenciaEnMinutos == 30) {
                        $disponible[] = $hora1->format('H:i');
                    }
                } else {
                    break;
                }
            }
        } elseif ($lapsoTurno == '90') {

            for ($i = 0; $i < $index; $i++) {
                if (isset($lapsosDisponibles[$i + 2])) {
                    $hora1 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i]);
                    $hora2 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i + 2]);
                    $diferenciaEnMinutos = $hora1->diffInMinutes($hora2);
                    if ($diferenciaEnMinutos == 60) {
                        $disponible[] = $hora1->format('H:i');
                    }
                } else {
                    break;
                }
            }
        } elseif ($lapsoTurno == '120') {
            for ($i = 0; $i < $index; $i++) {
                if (isset($lapsosDisponibles[$i + 3])) {
                    $hora1 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i]);
                    $hora2 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i + 3]);
                    $diferenciaEnMinutos = $hora1->diffInMinutes($hora2);
                    if ($diferenciaEnMinutos == 90) {
                        $disponible[] = $hora1->format('H:i');
                    }
                } else {
                    break;
                }
            }
        }

        return $disponible;
    }


    public function TurnosDisponiblesEmpresa($idTrabajador, $fecha, $lapsoTurno)
    {
        Carbon::setLocale('es');
        $fechaCarbon = Carbon::parse($fecha);

        $nombreDiaSemana = $fechaCarbon->isoFormat('dddd');
        $acentos = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
        $nombreDiaSinAcentos = str_replace($acentos, $sinAcentos, $nombreDiaSemana);
        $Disponibilidad = $this->DispSrv->DtrabajadorId($idTrabajador);

        if (!$Disponibilidad) {
            Log::error("Disponibilidad no encontrada para el trabajador");
            return [];
        }

        $horarioDelDia = $Disponibilidad->$nombreDiaSinAcentos;
        $horariosDisponibles = json_decode($horarioDelDia);

        if (!$horariosDisponibles) {
            Log::error("Horarios no disponibles para el día: $nombreDiaSinAcentos");
            return [];
        }

        $horainicio = Carbon::parse($horariosDisponibles[0] . ":" . $horariosDisponibles[1]);
        $horafin = Carbon::parse($horariosDisponibles[2] . ":" . $horariosDisponibles[3]);

        $lapsos = [];


        if ($horainicio < $horafin) {
            while ($horainicio < $horafin) {
                $lapsos[] = $horainicio->format('H:i');
                $horainicio->addMinutes(30);
            }
        }

        if ($horafin->lt($horainicio)) {
            // Ajustar la hora de fin si es menor que la hora de inicio (cruza medianoche)
            if ($horafin->lt($horainicio)) {
                $horafin->addDay(); // Añadir un día para manejar el rango que cruza medianoche
            }

            $current = $horainicio->copy(); // Crear una copia de la hora de inicio para modificar

            while ($current->lt($horafin)) {
                $lapsos[] = $current->format('H:i');
                $current->addMinutes(30);
            }
        }

        if ($horainicio->eq($horafin)) {
            // Agregar el valor inicial
            $lapsos[] = $horainicio->format('H:i');

            // Agregar 30 minutos a la hora de inicio
            $horainicio->addMinutes(30);

            // Bucle para agregar lapsos cada 30 minutos
            while ($horainicio->lt($horafin->copy()->addDay())) {
                $lapsos[] = $horainicio->format('H:i');
                $horainicio->addMinutes(30);
            }
        }

        $turnosOcupados = Turnos::whereDate('fechahora', $fechaCarbon->toDateString())
            ->where('idTrabajador', $idTrabajador)
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
        $lapsosDisponibles = array_diff($lapsos, $ocupado);
        $lapsosDisponibles = array_values($lapsosDisponibles);


        $disponible = [];
        $index = count($lapsosDisponibles);

        if ($lapsoTurno == '30') {
            $disponible = $lapsosDisponibles;
        } elseif ($lapsoTurno == '60') {

            for ($i = 0; $i < $index; $i++) {
                if (isset($lapsosDisponibles[$i + 1])) {
                    $hora1 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i]);
                    $hora2 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i + 1]);
                    $diferenciaEnMinutos = $hora1->diffInMinutes($hora2);
                    if ($diferenciaEnMinutos == 30) {
                        $disponible[] = $hora1->format('H:i');
                    }
                } else {
                    break;
                }
            }
        } elseif ($lapsoTurno == '90') {

            for ($i = 0; $i < $index; $i++) {
                if (isset($lapsosDisponibles[$i + 2])) {
                    $hora1 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i]);
                    $hora2 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i + 2]);
                    $diferenciaEnMinutos = $hora1->diffInMinutes($hora2);
                    if ($diferenciaEnMinutos == 60) {
                        $disponible[] = $hora1->format('H:i');
                    }
                } else {
                    break;
                }
            }
        } elseif ($lapsoTurno == '120') {
            for ($i = 0; $i < $index; $i++) {
                if (isset($lapsosDisponibles[$i + 3])) {
                    $hora1 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i]);
                    $hora2 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i + 3]);
                    $diferenciaEnMinutos = $hora1->diffInMinutes($hora2);
                    if ($diferenciaEnMinutos == 90) {
                        $disponible[] = $hora1->format('H:i');
                    }
                } else {
                    break;
                }
            }
        }

        return $disponible;
    }


    public function TurnosOcupados($idUser, $fecha)
    {
        Carbon::setLocale('es');
        $fechaCarbon = Carbon::parse($fecha);

        $nombreDiaSemana = $fechaCarbon->isoFormat('dddd');
        $acentos = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
        $nombreDiaSinAcentos = str_replace($acentos, $sinAcentos, $nombreDiaSemana);
        $Disponibilidad = $this->DispSrv->DUsuarioId($idUser);

        if (!$Disponibilidad) {
            Log::error("Disponibilidad no encontrada para el usuario ID: $idUser");
            return [];
        }

        $horarioDelDia = $Disponibilidad->$nombreDiaSinAcentos;
        $horariosDisponibles = json_decode($horarioDelDia);

        if (!$horariosDisponibles) {
            Log::error("Horarios no disponibles para el día: $nombreDiaSinAcentos");
            return [];
        }

        $horainicio = Carbon::parse($horariosDisponibles[0] . ":" . $horariosDisponibles[1]);
        $horafin = Carbon::parse($horariosDisponibles[2] . ":" . $horariosDisponibles[3]);

        $lapsos = [];
        while ($horainicio < $horafin) {
            $lapsos[] = $horainicio->format('H:i');
            $horainicio->addMinutes(30);
        }

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
        return array_values($ocupado);
    }

    public function TurnosOcupadosEmpresa($idTrabajador, $fecha)
    {
        Carbon::setLocale('es');
        $fechaCarbon = Carbon::parse($fecha);

        $nombreDiaSemana = $fechaCarbon->isoFormat('dddd');
        $acentos = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
        $nombreDiaSinAcentos = str_replace($acentos, $sinAcentos, $nombreDiaSemana);
        $Disponibilidad = $this->DispSrv->DtrabajadorId($idTrabajador);

        if (!$Disponibilidad) {
            Log::error("Disponibilidad no encontrada para el trabajador");
            return [];
        }

        $horarioDelDia = $Disponibilidad->$nombreDiaSinAcentos;
        $horariosDisponibles = json_decode($horarioDelDia);

        if (!$horariosDisponibles) {
            Log::error("Horarios no disponibles para el día: $nombreDiaSinAcentos");
            return [];
        }

        $horainicio = Carbon::parse($horariosDisponibles[0] . ":" . $horariosDisponibles[1]);
        $horafin = Carbon::parse($horariosDisponibles[2] . ":" . $horariosDisponibles[3]);

        $lapsos = [];
        while ($horainicio < $horafin) {
            $lapsos[] = $horainicio->format('H:i');
            $horainicio->addMinutes(30);
        }

        $turnosOcupados = Turnos::whereDate('fechahora', $fechaCarbon->toDateString())
            ->where('idTrabajador', $idTrabajador)
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
        return array_values($ocupado);
    }



    public function VerificadorDisponibilidad($idUser, $fecha)
    {
        $horariosOcupados = $this->TurnosOcupados($idUser, $fecha);
        $fechaHora = Carbon::parse($fecha);
        $fechaHoraDisponible = false;


        foreach ($horariosOcupados as $horario) {
            $horarioCarbon = $fechaHora->format('H:i');

            if ($horario == $horarioCarbon) {

                $fechaHoraDisponible = true;
                break;
            }
        }

        return $fechaHoraDisponible;
    }

    public function VerificadorDisponibilidadEmpresa($idTrabajador, $fecha)
    {
        $horariosOcupados = $this->TurnosOcupadosEmpresa($idTrabajador, $fecha);
        $fechaHora = Carbon::parse($fecha);
        $fechaHoraDisponible = false;


        foreach ($horariosOcupados as $horario) {
            $horarioCarbon = $fechaHora->format('H:i');

            if ($horario == $horarioCarbon) {

                $fechaHoraDisponible = true;
                break;
            }
        }

        return $fechaHoraDisponible;
    }
}
