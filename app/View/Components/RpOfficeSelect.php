<?php

namespace App\View\Components;

use App\Traits\UserInfoCollector;
use App\Traits\GenericInfoCollection;
use Illuminate\View\Component;

class RpOfficeSelect extends Component
{
    use UserInfoCollector, GenericInfoCollection;

    public $ministries = [];
    public $view_grid;
    public $is_unit_show;
    public $only_office;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($grid, $unit, $onlyoffice = false)
    {
        $this->view_grid = $grid;
        $this->is_unit_show = $unit;
        $this->only_office = $onlyoffice;

        //dd($this->current_office_id());
        $responseData = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-ministry-list'), [
            'directorate_id' => $this->current_office_id()
        ])->json();

        $ministries = isSuccess($responseData) ? $responseData['data']: [];

        $fiscal_years = $this->allFiscalYears();

        //dd($ministries);
        $this->ministries = $ministries;
        $this->fiscal_years = $fiscal_years;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $ministries = $this->ministries;
        $fiscal_years = $this->fiscal_years;

        return view('components.rp-office-select', compact('ministries','fiscal_years'));
    }
}
