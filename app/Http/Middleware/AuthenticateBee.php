<?php

namespace App\Http\Middleware;

use App\Traits\UserInfoCollector;
use Closure;
use Illuminate\Http\Request;

class AuthenticateBee
{
    use UserInfoCollector;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->checkLogin()) {
            return $this->forceLogout();
        }
        return $next($request);
    }
}
