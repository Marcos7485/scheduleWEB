<?php 


namespace App\Services;

use App\Models\Cliente;

class ClienteSrv {

    public function RegistrarCliente($telefono, $name){

        $exist = Cliente::where('telefono', $telefono)->first();

        if (empty($exist)) {
            // No hay resultados que coincidan con el teléfono proporcionado
            $cliente = new Cliente;
            $cliente->nombre = $name;
            $cliente->telefono = $telefono;
            $cliente->frequency = 1;
            $cliente->save();
        } else {
            // Hay resultados que coinciden con el teléfono proporcionado
            $exist[0]->frequency = $exist[0]->frequency + 1;
            $exist[0]->save();
        }

        return Cliente::where('telefono', $telefono)->first();
    }


}