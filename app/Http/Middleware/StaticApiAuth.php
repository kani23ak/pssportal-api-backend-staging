<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaticApiAuth
{
    public function handle(Request $request, Closure $next)
    {
        $username = $request->getUser();
        $password = $request->getPassword();

        // DEBUG
        // dd($user, $pass); // admin, 12345

        $configUsername = config('app.username');
        $configPassword = config('app.password');

        if ($username !== $configUsername || $password !== $configPassword) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }


        return $next($request);
    }
}
