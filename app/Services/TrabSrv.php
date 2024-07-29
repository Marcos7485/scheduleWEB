<?php 


namespace App\Services;

use App\Models\Empresa;
use App\Models\Trabajadores;
use App\Models\User;

class TrabSrv {

    public function TransformTrabajador($id){
        $trabajador = Trabajadores::where('id', $id)->first();
        $empresa = Empresa::where('id', $trabajador->idEmpresa)->first();

        $results = [
            'trabajador' => $trabajador,
            'empresa' => $empresa
        ];

        return $results;
    }

    public function TrabajadoresUser($idUser){
        $empresa = Empresa::where('idUser', $idUser)->first();
        $trabajadores = Trabajadores::where('idEmpresa', $empresa->id)->get();
        $results = [
            'trabajadores' => $trabajadores,
            'empresa' => $empresa
        ];
        return $results;
    }

    public function DTrabajadorUser($id){
        $empresa = Empresa::where('idUser', $id)->first();
    }

}