<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenericRPUController extends Controller
{
    public function getMinistries()
    {
        $ministries = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-ministry-list'), ['all' => 1])->json();
        return isSuccess($ministries) ? $ministries['data'] : [];
    }

    public function getMinistryWiseOfficeLayer(Request $request)
    {
        if ($request->has('ministry_id')) {
            $ministry_id = $request->ministry_id;
        } else if ($request->has('parent_ministry_id')) {
            $ministry_id = $request->parent_ministry_id;
        } else {
            $ministry_id = null;
        }
        $layer = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-layer-ministry-wise'), ['ministry_id' => $ministry_id])->json();
        return isSuccess($layer) ? $layer['data'] : [];
    }

    public function getControllingOfficeLayerByMinistryOrDivision(Request $request)
    {
        if ($request->has('ministry_id')) {
            $ministry_id = $request->ministry_id;
        }
        $layer = $this->initRPUHttp()->post(config('cag_rpu_api.get-controlling-office-layer-by-ministry-or-division'), ['office_ministry_id' => $ministry_id])->json();
        return isSuccess($layer) ? $layer['data'] : [];
    }

    public function getOfficeUnitLayerByControllingOfficeLayer(Request $request)
    {
        $layer = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-unit-layer-by-controlling-office-layer'), ['office_ministry_id' => $request->ministry_id, 'controlling_office_layer_id' => $request->controlling_office_layer_id])->json();
        return isSuccess($layer) ? $layer['data'] : [];
    }

    public function getMinistryLayerWiseOffice(Request $request)
    {
        $ministry_id = $request->ministry_id;
        $layer_id = $request->layer_id;
        $rp_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-rp-office-ministry-and-layer-wise'), ['office_ministry_id' => $ministry_id, 'office_layer_id' => $layer_id])->json();
        return isSuccess($rp_offices) ? $rp_offices['data'] : [];
    }
}
