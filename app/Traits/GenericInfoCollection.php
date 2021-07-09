<?php

namespace App\Traits;

trait GenericInfoCollection
{
    use ApiHeart, UserInfoCollector;

    public function fiscalYears()
    {
        if (session()->has('fiscalYears')) {
            return session('fiscalYears');
        } else {
            $fiscal_years = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.fiscal_year_lists'), [
                'all' => 1
            ])->json();
            if ($fiscal_years['status'] == 'success') {
                session('fiscalYears', $fiscal_years['data']);
                return $fiscal_years['data'];
            } else {
                return [];
            }
        }
    }
}
