<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanesController extends Controller
{
    public function suscripcion(){
        $user = Auth::user();
        $planes = Planes::where('active', 1)->get();

        $data = [
            'planes' => $planes
        ];
        
        return view('planes.suscripcionUser', $data);
    }
}
