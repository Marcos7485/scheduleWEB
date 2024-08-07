<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanesController extends Controller
{

    public function suscripcion(){
        $user = Auth::user();
        $planes = Planes::where('active', 1)->get();
        $userPlan = UserPlan::where('id', $user->id)->where('active', 1)->first();

        $data = [
            'planes' => $planes
        ];
        
        return view('planes.suscripcionUser', $data);
    }
}
