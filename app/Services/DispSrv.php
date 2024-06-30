<?php

namespace App\Services;

use App\Models\Disponibilidad;
use Carbon\Carbon;

// Disponibilidad Services
class DispSrv
{

    protected $TurnosSrv;

    public function __construct(TurnosSrv $TurnosSrv)
    {
        $this->TurnosSrv = $TurnosSrv;
    }

    public function DUsuarioId($id)
    {
        return Disponibilidad::where('idUser', $id)->first();
    }


    public function Dates()
    {
        Carbon::setLocale('es');

        $diahoy = Carbon::now()->translatedFormat('l'); // nombre
        $fechahoy = Carbon::now()->format('d/m'); // dia-mes
        $hoy = Carbon::now()->toDateString(); // dd-mm-yyyy
        $fechayhoraActual = Carbon::now();
        $inicioSemana = Carbon::now()->startOfWeek(Carbon::MONDAY); // Lunes de esta semana
        $finSemana = Carbon::now()->endOfWeek(Carbon::SUNDAY); // Domingo de esta semana
        $inicioSemanaProxima = Carbon::now()->addWeek()->startOfWeek(Carbon::MONDAY);
        $finSemanaProxima = $inicioSemanaProxima->copy()->endOfWeek(Carbon::SUNDAY);
        $inicioMes = Carbon::now()->startOfMonth(); // Primer día del mes actual
        $finMes = Carbon::now()->endOfMonth(); // Último día del mes actual
        $subTwoDays = Carbon::now()->subDays(2)->toDateString();


        $results = [
            'diahoy' => $diahoy,
            'fechahoy' => $fechahoy,
            'hoy' => $hoy,
            'datetimenow' => $fechayhoraActual,
            'inicioSemana' => $inicioSemana,
            'finSemana' => $finSemana,
            'inicioSemanaProx' => $inicioSemanaProxima,
            'finSemanaProx' => $finSemanaProxima,
            'inicioMes' => $inicioMes,
            'finMes' => $finMes,
            'subTwoDays' => $subTwoDays
        ];

        return $results;
    }

    public function LapsosDisponibles($idUser, $fecha)
    {
        Carbon::setLocale('es');
        $fechaCarbon = Carbon::parse($fecha);
        $nombreDiaSemana = $fechaCarbon->isoFormat('dddd');
        $acentos = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
        $nombreDiaSinAcentos = str_replace($acentos, $sinAcentos, $nombreDiaSemana);
        $Disponibilidad = $this->DUsuarioId($idUser);
        $horarioDelDia = $Disponibilidad->$nombreDiaSinAcentos;
        $horariosDisponibles = json_decode($horarioDelDia);

        $horainicio = Carbon::parse($horariosDisponibles[0] . ":" . $horariosDisponibles[1]);
        $horafin = Carbon::parse($horariosDisponibles[2] . ":" . $horariosDisponibles[3]);

        $lapsos = [];
        while ($horainicio < $horafin) {
            $lapsos[] = $horainicio->format('H:i');
            $horainicio->addMinutes(30);
        }

        return $lapsos;
    }

    public function HorariosDisponibles($lapsos, $ocupado, $lapsoTurno)
    {

        $lapsosDisponibles = array_diff($lapsos, $ocupado);
        $lapsosDisponibles = array_values($lapsosDisponibles);
        $index = count($lapsosDisponibles);

        if ($lapsoTurno == '30') {
            $disponible = $lapsosDisponibles;
        } elseif ($lapsoTurno == '60') {
            for ($i = 0; $i < $index; $i++) {
                if (isset($lapsosDisponibles[$i + 1])) {
                    $hora1 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i]);
                    $hora2 = Carbon::createFromFormat('H:i', $lapsosDisponibles[$i + 1]);
                    $diferenciaEnMinutos = $hora1->diffInMinutes($hora2);
                    if ($diferenciaEnMinutos == "30") {
                        array_push($disponible, $hora1->format('H:i'));
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
                    if ($diferenciaEnMinutos == "90") {
                        array_push($disponible, $hora1->format('H:i'));
                    }
                } else {
                    break;
                }
            }
        }

        return response()->json($disponible);
    }

    public function VerificadorDisponibilidad($idUser, $fecha, $duracion, $fechaHoraString)
    {
        $lapsos = $this->LapsosDisponibles($idUser, $fecha);
        $ocupado = $this->TurnosSrv->TurnosOcupados($idUser, $fecha);

        $lapsosDisponibles = array_diff($lapsos, $ocupado);
        $lapsosDisponibles = array_values($lapsosDisponibles);

        $horariosDisponibles = $this->HorariosDisponibles($lapsos, $ocupado, $duracion);

        $fechaHora = Carbon::parse($fechaHoraString);

        $fechaHoraDisponible = false;
        foreach ($horariosDisponibles as $horario) {
            if ($horario->equalTo($fechaHora)) { 
                $fechaHoraDisponible = true;
                break;
            }
        }

        return $fechaHoraDisponible;
    }
}
