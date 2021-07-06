<?php

namespace App\View\Components;

use App\Models\OfficeCustomLayer;
use App\Traits\UserInfoCollector;
use Illuminate\View\Component;

class OfficeSelect extends Component
{
    use UserInfoCollector;

    public $custom_layers = [];
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

//        $layer_levels = OfficeCustomLayer::select('layer_level')->groupBy('layer_level')->get();
//
//        $layers = OfficeCustomLayer::get();
//        $custom_layers_temp = array();
//        $custom_layers = array();
//        foreach ($layer_levels as $key => $value) {
//            $name = '';
//            foreach ($layers as $key => $layer) {
//
//                if ($value->layer_level == $layer->layer_level) {
//                    if ($value->layer_level == 3) {
//                        $name = 'অন্যান্য দপ্তর/সংস্থা';
//                    } else {
//                        $name .= $layer->name . '/';
//                    }
//                }
//            }
//            $custom_layers_temp['id'] = $value->layer_level;
//            $custom_layers_temp['name'] = trim($name, '/');
//            $custom_layers[] = $custom_layers_temp;
//        }
        $custom_layers = [];
        $this->custom_layers = $custom_layers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $custom_layers = $this->custom_layers;

//        if ($this->getUserOrganogramRole() == config('menu_role_map.office_admin') || $this->getUserOrganogramRole()
//            == config('menu_role_map.unit_admin')) {
//            $office_id = Auth::user()->current_office_id();
//        } else {
//            $office_id = null;
//        }
        $office_id = null;

        return view('components.office-select', compact('custom_layers', 'office_id'));
    }
}
