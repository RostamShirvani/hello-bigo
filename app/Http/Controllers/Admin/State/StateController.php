<?php

namespace App\Http\Controllers\Admin\State;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Repositories\Admin\StateRepository;

class StateController extends BaseAdminController
{
    protected $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }
}
