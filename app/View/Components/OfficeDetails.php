<?php

namespace App\View\Components;

use App\Traits\UserInfoCollector;
use App\Traits\GenericInfoCollection;
use Illuminate\View\Component;

class OfficeDetails extends Component
{
    use UserInfoCollector, GenericInfoCollection;

    public $office_details = [];
    public $office_name_en;
    public $office_name_bn;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $office_name_en = $this->current_office()['office_name_en'];
        $office_name_bn = $this->current_office()['office_name_bn'];
        $office_details = $this->current_office_details();

        $this->office_details = $office_details;
        $this->office_name_en = $office_name_en;
        $this->office_name_bn = $office_name_bn;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $office_details = $this->office_details;
        $office_name_en = $this->office_name_en;
        $office_name_bn = $this->office_name_bn;
        return view('components.office-details-template', compact('office_details','office_name_en','office_name_bn'));
    }
}
