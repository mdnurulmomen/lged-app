<?php

namespace App\Traits;

trait GenericInfoCollection
{
    use ApiHeart, UserInfoCollector;

    public function allFiscalYears()
    {
        $fiscal_years = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_lists'), ['all' => 1])->json();
        if ($fiscal_years['status'] == 'success') {
            return $fiscal_years['data'];
        } else {
            return [];
        }
    }

    public function allStrategicPlanDurations()
    {
        $fiscal_years = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_duration_lists'), ['all' => 1])->json();
        if ($fiscal_years['status'] == 'success') {
            session('strategic_outcomes', $fiscal_years['data']);
            return $fiscal_years['data'];
        } else {
            return [];
        }
    }

    public function allCostCenterType()
    {
        $cost_center_types = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.cost_center_type_lists'), ['all' => 1])->json();
        if ($cost_center_types['status'] == 'success') {
            return $cost_center_types['data'];
        } else {
            return [];
        }
    }

    public function allStrategicPlanOutcomes()
    {
        $plan_outcome = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_lists'), ['all' => 1])->json();
        if ($plan_outcome['status'] == 'success') {
            session('strategic_outcomes', $plan_outcome['data']);
            return $plan_outcome['data'];
        } else {
            return [];
        }
    }

    public function strategicPlanOutputByOutcome($outcome_id)
    {
        $plan_output = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_output_by_outcome'), ['outcome_id' => $outcome_id])->json();
        if ($plan_output['status'] == 'success') {
            return $plan_output['data'];
        } else {
            return [];
        }
    }

    public function strategicPlanOutcomeRemarks($outcome_id)
    {
        $plan_output = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.strategic_plan_outcome_remarks'), ['outcome_id' => $outcome_id])->json();
        if ($plan_output['status'] == 'success') {
            return $plan_output['data'];
        } else {
            return [];
        }
    }

    public function allResponsibleOffices()
    {
        $offices = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.responsible_offices_lists'), ['all' => 1])->json();
        if ($offices['status'] == 'success') {
            return $offices['data'];
        } else {
            return [];
        }
    }


    public function allAuditDirectorates()
    {
        $offices = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.directorate_lists'), ['all' => 1])->json();
        return $offices;
        if (\Arr::has($offices, 'status') && $offices['status'] == 'success') {
            return $offices['data'];
        } else {
            return [];
        }
    }

    public function cagDoptorOtherOffices($own_office_id)
    {
        $officer_lists = $this->initDoptorHttp()->post(config('cag_doptor_api.other_offices'), ['own_office_id' => $own_office_id])->json();

        if ($officer_lists['status'] == 'success') {
            return $officer_lists['data'];
        } else {
            return [];
        }
    }

    public function cagDoptorOfficeUnitDesignationEmployees($office_id)
    {
        $officer_lists = $this->initDoptorHttp()->post(config('cag_doptor_api.office_unit_designation_employee_map'), ['office_id' => $office_id])->json();

        if ($officer_lists['status'] == 'success') {
            return $officer_lists['data'];
        } else {
            return [];
        }
    }

    public function getAuditTemplate($template_type, $lang = 'en'): array
    {
        return $this->initHttpWithToken()->post(config('amms_bee_routes.audit_template_show'), ['template' => $template_type, 'language' => $lang])->json();
    }

}
