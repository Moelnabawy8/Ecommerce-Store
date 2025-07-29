<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    protected $guards = ['admin', 'seller', 'web'];

    public function handle(Request $request, Closure $next): Response
    {
        foreach ($this->guards as $guard) {
            $user = Auth::guard($guard)->user();
            if ($user) {
                if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
                    return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : redirect()->route("$guard.verification.notice");
                }

                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
