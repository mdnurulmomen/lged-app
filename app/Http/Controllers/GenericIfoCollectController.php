<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenericIfoCollectController extends Controller
{
    public function getStrategicOutputByOutcome(Request $request)
    {
        $outcome_id = $request->outcome_id;
        return $this->strategicPlanOutputByOutcome($outcome_id);
    }

    public function getStrategicOutcomeRemarks(Request $request)
    {
        $outcome_id = $request->outcome_id;
        return $this->strategicPlanOutcomeRemarks($outcome_id);
    }

    public function cagDoptorMasterDesignations()
    {
        return $this->cagDoptorMasterDesignations();
    }
}
