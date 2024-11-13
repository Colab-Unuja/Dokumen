<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('index');
        }

        $kategori = Auth::guard($guard)->user()->kategori;

        // Mapping kategori ke rute dasar yang sesuai
        $routes = [
            'admin' => 'admin.index',
            'karyawan' => 'karyawan.index',
            'mahasiswa' => 'mahasiswa.index',
            'dosen' => 'dosen.index',
        ];

        // Cek apakah rute yang diakses sudah sesuai kategori
        if (array_key_exists($kategori, $routes)) {
            $expectedRoute = route($routes[$kategori], [], false); // Rute yang diharapkan tanpa domain

            if (!$request->is(trim($expectedRoute, '/').'*')) {
                return redirect()->route($routes[$kategori]);
            }
        }

        return $next($request);
    }
}
