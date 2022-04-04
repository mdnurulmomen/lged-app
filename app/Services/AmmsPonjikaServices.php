<?php

namespace App\Services;

use App\Traits\ApiHeart;

class AmmsPonjikaServices
{
    use ApiHeart;

    public function loadPendingTasks()
    {
        $pending_tasks = $this->initPonjikaHttp()->post(config('cag_ponjika_api.tasks.pending'))->json();
    }

    public function loadAllTasks()
    {

    }
}
