<?php

namespace App\Http\Middleware;

use App\Traits\UserInfoCollector;
use Closure;
use Illuminate\Http\Request;

class OfficeDomainRedirection
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
        if (config('cag_amms_config.office_domain_redirection') && request()->getHttpHost() != $this->current_office_domain()) {
            return redirect($this->current_office_domain());
        }
        return $next($request);
    }
}
