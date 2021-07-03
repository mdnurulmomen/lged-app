<?php

namespace App\Http\Controllers;

use App\Traits\UserInfoCollector;
use http\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, UserInfoCollector;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($this->checkLogin()) {
                self::viewSharer();
            }
            return $next($request);
        });

    }

    public function viewSharer()
    {
//        $wizard = $this->wizard();
//        view()->share('wizardData', $wizard);

        $userDetails = $this->getUserDetails();
        view()->share('userDetails', $userDetails);

        $userOffices = $this->getUserOfficesByDesignation();
        view()->share('userOffices', $userOffices);
    }

    public function wizard()
    {
        if (!session('_wizard')) {
            $http = new Client();
            $response = $http->get(config('n_doptor_apps.wizard_url'));
            $data = json_decode($response->getBody()->getContents(), true);
            session()->put(['_wizard' => $data['data']]);
            session()->save();
        }
        return session('_wizard');
    }
}
