<?php

namespace App\Traits;

trait GenericInfoCollection
{
    use ApiHeart, UserInfoCollector;

    public function allFiscalYears()
    {
        $fiscal_years = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_lists'), [
            'all' => 1
        ])->json();
        if ($fiscal_years['status'] == 'success') {
            return $fiscal_years['data'];
        } else {
            return [];
        }
    }

    public function allStrategicPlanDurations()
    {
        $fiscal_years = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), [
            'all' => 1
        ])->json();
        if ($fiscal_years['status'] == 'success') {
            session('strategic_outcomes', $fiscal_years['data']);
            return $fiscal_years['data'];
        } else {
            return [];
        }
    }

    public function allStrategicPlanOutcomes()
    {
        $plan_outcome = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_lists'), [
            'all' => 1
        ])->json();
        if ($plan_outcome['status'] == 'success') {
            session('strategic_outcomes', $plan_outcome['data']);
            return $plan_outcome['data'];
        } else {
            return [];
        }
    }

    public function strategicPlanOutputByOutcome($outcome_id)
    {
        $plan_output = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_by_outcome'), [
            'outcome_id' => $outcome_id
        ])->json();
        if ($plan_output['status'] == 'success') {
            return $plan_output['data'];
        } else {
            return [];
        }
    }

    public function strategicPlanOutcomeRemarks($outcome_id)
    {
        $plan_output = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_remarks'), [
            'outcome_id' => $outcome_id
        ])->json();
        if ($plan_output['status'] == 'success') {
            return $plan_output['data'];
        } else {
            return [];
        }
    }

    public function allResponsibleOffices()
    {
        $offices = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.responsible_offices_lists'), [
            'all' => 1
        ])->json();
        if ($offices['status'] == 'success') {
            return $offices['data'];
        } else {
            return [];
        }
    }

}
