<?php

namespace App\Services;

use App\Models\UserPlan;
use Illuminate\Support\Facades\Log;

class PlanesSrv
{

    public function trialDays($idUser)
    {
        $userPlan = UserPlan::where('id', $idUser)->where('active', 1)->first();
        if ($userPlan->vencimiento !== null) {
            $daysDifference = $userPlan->created_at->diffInDays($userPlan->vencimiento);
            return floor($daysDifference);
        } else {
            return null;
        }
    }
}
