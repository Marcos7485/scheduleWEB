<?php

namespace App\Services;

use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PlanesSrv
{

    public function trialDays($idUser)
    {
        $userPlan = UserPlan::where('idUser', $idUser)->where('active', 1)->first();
        $today = Carbon::now();
        if ($userPlan->vencimiento !== null) {

            $daysDifference = $today->diffInDays($userPlan->vencimiento);

            if ($daysDifference > 0) {
                return floor($daysDifference);
            } else {
                return 0;
            }

        } else {
            return null;
        }
    }
}
