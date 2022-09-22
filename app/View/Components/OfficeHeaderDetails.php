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


    public function __construct($officeid='',$onlyofficename='')
    {

        $directorateInfo = $officeid ?   $this->initDoptorHttp()->post(config('cag_doptor_api.offices'), ['office_ids' => $officeid])->json() : [];

        if($officeid){
            $directorateInfo =  $directorateInfo['status'] == 'success'? $directorateInfo['data']:[];
        }


//        dd($directorateInfo);

        $office_name_en = $officeid ? $directorateInfo[$officeid]['office_name_eng'] :  $this->current_office()['office_name_en'];
        $office_name_bn = $officeid ? $directorateInfo[$officeid]['office_name_bng'] :  $this->current_office()['office_name_bn'];
        $office_details = $officeid ? $directorateInfo[$officeid] : $this->current_office_details();
//        dd($office_name_bn);
        $this->office_details = $office_details;
        $this->office_name_en = $office_name_en;
        $this->office_name_bn = $office_name_bn;
        $this->only_office_name = $onlyofficename;
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
        $only_office_name = $this->only_office_name;

        return view('components.office-header-details',compact(
            'office_details',
            'office_name_en',
            'office_name_bn',
            'only_office_name',
        ));
    }
}
