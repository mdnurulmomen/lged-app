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
        if ($offices['status'] == 'success') {
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

    public function cagDoptorMasterDesignations()
    {
        $designations = $this->initDoptorHttp()->post(config('cag_doptor_api.designation_master_data'), [])->json();
        if ($designations['status'] == 'success') {
            return $designations['data'];
        } else {
            return [];
        }
    }

    public function getAuditTemplate($template_type, $template_name, $lang = 'en'): array
    {
        return $this->initHttpWithToken()->post(config('amms_bee_routes.audit_template_show'), ['template_type' => $template_type, 'template_name' => $template_name, 'language' => $lang])->json();
    }

    public function yearWiseVacationList($year)
    {
        $data['year'] = $year;
        $list = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.vacation-date.year-wise-vacation-list'),$data)->json();
        if ($list['status'] == 'success') {
            return $list['data'];
        } else {
            return [];
        }
    }

    public function getTeam($team_id)
    {
        $data['team_id'] = $team_id;
        $data['cdesk'] = $this->current_desk_json();
        $list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.get_team_info'),$data)->json();
        return $list['status'] == 'success' ? $list['data'] : [];
    }

    public function getPlanAndTeamWiseTeamMembers($audit_plan_id,$team_id)
    {
        $data['audit_plan_id'] = $audit_plan_id;
        $data['team_id'] = $team_id;
        $data['cdesk'] = $this->current_desk_json();
        $list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.get_audit_plan_and_team_wise_team_members'),$data)->json();
        return $list['status'] == 'success' ? $list['data'] : [];
    }
}
