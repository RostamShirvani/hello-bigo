<?php

namespace App\Repositories\Admin;

use App\Enums\EState;

class StateRepository extends BaseAdminRepository
{
    public function changeState($stateableId, $stateableType)
    {
        $model = call_user_func_array($stateableType . "::find", [$stateableId]);

        $model->state = $model->state == EState::ENABLED ? EState::DISABLED : EState::ENABLED;
        $model->save();

        return $model;
    }
}
