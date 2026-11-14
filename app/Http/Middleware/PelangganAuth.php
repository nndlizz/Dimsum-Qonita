<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PelangganAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pelanggan sudah login atau belum
        if (!session()->has('pelanggan_id') && !session()->has('id_pelanggan')) {
            // Kalau belum, tendang ke halaman login dan ingat-ingat URL yang mau dia tuju
            return redirect()->guest(route('login'))
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}