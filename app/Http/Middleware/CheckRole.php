<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

//        dd($user->assignRole('manager'));
        if (!$user) {
            abort(403);
        }

//        dd($user, $user->hasAnyRole($roles));
        if (!empty($roles) && !$user->hasAnyRole($roles)) {
            abort(403);
        }

        return $next($request);
    }
}
