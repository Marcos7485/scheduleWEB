<?php

namespace App\Services;

use App\Models\Disponibilidad;
use App\Models\EmpresaDispo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DispSrv
{

    public function DUsuarioId($id)
    {
        return Disponibilidad::where('idUser', $id)->first();
    }

    
    public function DtrabajadorId($id)
    {
        return EmpresaDispo::where('idTrabajador', $id)->where('active', 1)->first();
    }

    public function Dates()
    {
        Carbon::setLocale('es');

        $results = [
            'diahoy' => Carbon::now()->translatedFormat('l'),
            'fechahoy' => Carbon::now()->format('d/m'),
            'hoy' => Carbon::now()->toDateString(),
            'datetimenow' => Carbon::now(),
            'inicioSemana' => Carbon::now()->startOfWeek(Carbon::MONDAY),
            'finSemana' => Carbon::now()->endOfWeek(Carbon::SUNDAY),
            'inicioSemanaProx' => Carbon::now()->addWeek()->startOfWeek(Carbon::MONDAY),
            'finSemanaProx' => Carbon::now()->addWeek()->endOfWeek(Carbon::SUNDAY),
            'inicioMes' => Carbon::now()->startOfMonth(),
            'finMes' => Carbon::now()->endOfMonth(),
            'subTwoDays' => Carbon::now()->subDays(2)->toDateString(),
        ];

        return $results;
    }

}
