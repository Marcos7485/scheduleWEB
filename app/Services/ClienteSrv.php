<?php 


namespace App\Services;

use App\Models\Cliente;

class ClienteSrv {

    public function RegistrarCliente($telefono, $name){

        $exist = Cliente::where('telefono', $telefono)->first();

        if ($exist == null) {
         
            // No hay resultados que coincidan con el teléfono proporcionado
            $cliente = new Cliente;
            $cliente->nombre = $name;
            $cliente->telefono = $telefono;
            $cliente->frequency = 1;
            $cliente->save();
        } else {

            // Hay resultados que coinciden con el teléfono proporcionado
            $exist->frequency = $exist->frequency + 1;
            $exist->save();
        }

        return Cliente::where('telefono', $telefono)->first();
    }

    public function RegistrarClienteEmpresa($telefono, $name, $idEmpresa){

        $exist = Cliente::where('telefono', $telefono)->where('idEmpresa', $idEmpresa)->first();

        if ($exist == null) {
         
            // No hay resultados que coincidan con el teléfono proporcionado
            $cliente = new Cliente;
            $cliente->idEmpresa = $idEmpresa;
            $cliente->nombre = $name;
            $cliente->telefono = $telefono;
            $cliente->frequency = 1;
            $cliente->save();
        } else {

            // Hay resultados que coinciden con el teléfono proporcionado
            $exist->frequency = $exist->frequency + 1;
            $exist->save();
        }

        return Cliente::where('telefono', $telefono)->where('idEmpresa', $idEmpresa)->first();
    }
}