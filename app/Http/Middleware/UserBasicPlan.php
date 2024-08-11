<?php

namespace App\Http\Middleware;

use App\Models\UserPlan;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserBasicPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $userPlan = UserPlan::where('idUser', Auth::user()->id)->first();

        if ($userPlan) {
            if ($userPlan->idPlan == 1 || Carbon::parse($userPlan->vencimiento)->isFuture()) {
                return $next($request);
            } else {
                return redirect()->route('suscripcion');
            }
        }

        return $next($request);
    }
}
