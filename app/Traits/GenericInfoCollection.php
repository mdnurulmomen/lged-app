<?php

namespace App\Traits;

trait GenericInfoCollection
{
    use ApiHeart, UserInfoCollector;

    public function fiscalYears()
    {
        return [];
    }
}
