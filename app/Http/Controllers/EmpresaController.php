<?php

namespace App\Http\Controllers;

use App\Models\Disponibilidad;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function empresa(){
        $user = Auth::user();

        $Disponibilidad = Disponibilidad::where('idUser', $user->id)->first();
        $empresa = Empresa::where('idDisponibilidad', $Disponibilidad->id)->first();

        $data = ['empresa' => $empresa];
        return view('empresa.menu', $data);
    }
}
