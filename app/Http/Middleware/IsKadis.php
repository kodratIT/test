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
        // Temporary bypass untuk AJAX export requests saat development
        // REMOVE IN PRODUCTION!
        if ($request->is('*/export-excel') && $request->ajax()) {
            \Log::warning('Bypassing Kadis auth for export request - REMOVE IN PRODUCTION');
            return $next($request);
        }
        
        // cek apakah user login dan role_pengguna sesuai
        if (!Auth::check() || Auth::user()->role_pengguna !== 'kadis') {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Authentication required. Please login as Kadis.',
                    'redirect' => route('login')
                ], 401);
            }
            abort(403, 'Akses ditolak');
        }

        // kalau tidak sesuai role_pengguna → Forbidden
        return $next($request);
    }
}