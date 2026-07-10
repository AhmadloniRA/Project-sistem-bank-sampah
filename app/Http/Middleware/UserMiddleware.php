<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     * Only allow users with 'user' role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->isUser()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Anda harus login terlebih dahulu.']);
        }

        return $next($request);
    }
}
