<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('login')) {
            return redirect('/login');
        }

        if (session('idrole') != 1) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')
                ->with('error', 'Akses hanya diperbolehkan untuk Super Admin.');
        }

        return $next($request);
    }
}
