<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->deleted_at != null || $user->mitra_active == 'n') {
                Auth::logout();
                return redirect('/')->with('status', 'Your account has been banned');
            }
        }

        return $next($request);
    }
}
