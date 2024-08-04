<?php


namespace App\Services;

use App\Models\Cliente;

class ClienteSrv
{

    public function RegistrarCliente($telefono, $name)
    {
        $cliente = new Cliente;
        $cliente->nombre = $name;
        $cliente->telefono = $telefono;
        $cliente->frequency = 1;
        $cliente->save();

        return $cliente;
    }

    public function RegistrarClienteEmpresa($telefono, $name, $idEmpresa)
    {

        $cliente = new Cliente;
        $cliente->idEmpresa = $idEmpresa;
        $cliente->nombre = $name;
        $cliente->telefono = $telefono;
        $cliente->frequency = 1;
        $cliente->save();

        return $cliente;
    }

    
}
