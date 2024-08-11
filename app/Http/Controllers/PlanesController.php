<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use App\Models\UserPlan;
use App\Services\PlanesSrv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanesController extends Controller
{
    protected $PlanesSrv;

    public function __construct(PlanesSrv $PlanesSrv)
    {
        $this->PlanesSrv = $PlanesSrv;
    }

    public function suscripcionVisit()
    {
        $planes = Planes::where('active', 1)->get();
        $data = [
            'planes' => $planes
        ];

        return view('planes.suscripcionVisit', $data);
    }

    public function suscripcion()
    {
        $user = Auth::user();
        $planes = Planes::where('active', 1)->get();
        $userPlan = UserPlan::where('idUser', $user->id)->where('active', 1)->first();

        $roundedDaysDifference = $this->PlanesSrv->trialDays($user->id);

        if ($userPlan->idPlan == null) {
            $planActivo = null;
        } else {
            $planActivo = Planes::where('id', $userPlan->idPlan)->where('active', 1)->first();
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
        $plan = Planes::where('id', $id)->where('active', 1)->first();

        $data = [
            'plan' => $plan
        ];

        return view('planes.selected', $data);
    }
}
