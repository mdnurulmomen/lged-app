<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocalePersistence
{
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
//        if (Session::has('locale') && array_key_exists(Session::get('locale'), Config::get('cag_amms_config.lang'))) {
            App::setLocale(Session::get('locale'));
        } else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.fallback_locale'));
        }
        return $next($request);
    }
}
