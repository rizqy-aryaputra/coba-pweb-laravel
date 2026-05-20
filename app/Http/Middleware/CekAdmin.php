<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user bukan admin
        if (auth()->user()->role != 'admin') {

            return redirect('/')
                ->with('error', 'Akses ditolak!');

        }

        // Jika admin, lanjutkan request
        return $next($request);
    }
}