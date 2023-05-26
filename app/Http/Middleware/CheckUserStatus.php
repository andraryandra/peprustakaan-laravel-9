<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Cek jika status pengguna adalah 'INACTIVE'
            if ($user->status === 'INACTIVE') {
                // Logout pengguna
                Auth::logout();

                // Redirect ke halaman login dengan pesan informasi
                return redirect('/login')->with('status', 'Anda telah logout otomatis karena status Anda telah menjadi "INACTIVE".');
            }
        }

        return $next($request);
    }
}
