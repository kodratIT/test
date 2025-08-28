<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsKadis
{
    /**
     * @param \Closure(\Illuminate\Http\Request):(\Symfony\Component\HttpFoundation\Response) $next
    
     */
    
    public function handle($request, Closure $next): Response
    {
       
        // cek apakah user login dan role_pengguna sesuai
        if (!Auth::check() || Auth::user()->role_pengguna !== 'kadis') {
            abort(403, 'Akses ditolak');
        }

        // kalau tidak sesuai role_pengguna → Forbidden
        return $next($request);
    }
}