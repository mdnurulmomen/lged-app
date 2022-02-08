<?php

namespace App\View\Components;

use App\Traits\UserInfoCollector;
use App\Traits\GenericInfoCollection;
use Illuminate\View\Component;

class OfficeHeaderDetails extends Component
{
    use UserInfoCollector, GenericInfoCollection;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $office_details;
    public $office_name_en;
    public $office_name_bn;


    public function __construct()
    {
        $office_name_en = $this->current_office()['office_name_en'];
        $office_name_bn = $this->current_office()['office_name_bn'];
        $office_details = $this->current_office_details();
//        dd($office_name_bn);
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
//        dd($office_name_bn);
        return view('components.office-header-details',compact('office_details','office_name_en','office_name_bn'));
    }
}
