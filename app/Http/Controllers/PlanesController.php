<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanesController extends Controller
{

    public function suscripcion()
    {
        $user = Auth::user();
        $planes = Planes::where('active', 1)->get();
        $userPlan = UserPlan::where('id', $user->id)->where('active', 1)->first();

        if ($userPlan->idPlan == null) {
            $daysDifference = $userPlan->created_at->diffInDays($userPlan->vencimiento);
            $roundedDaysDifference = floor($daysDifference);
            $planActivo = null;
        } else {
            $planActivo = Planes::where('id', $userPlan->idPlan)->where('active', 1)->first();
            $roundedDaysDifference = null;
        }

        $data = [
            'planes' => $planes,
            'userPlan' => $planActivo,
            'trial' => $roundedDaysDifference
        ];

        return view('planes.suscripcionUser', $data);
    }

    public function suscripcionSelected($id)
    {
        $user = Auth::user();
        $plan = Planes::where('id', $id)->where('active', 1)->first();
        
        $data = [
            'plan' => $plan,
            'user' => $user
        ];

        return view('planes.selected', $data);
    }
}
