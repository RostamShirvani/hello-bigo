<?php

namespace App\Http\Controllers\Admin\State;

use App\Enums\EState;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\State\UpdateStateRequest;
use App\Repositories\Admin\StateRepository;
use Illuminate\Support\Facades\Response;

class StateAjaxController extends BaseAdminController
{
    protected $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function update(UpdateStateRequest $request) {
        $model = $this->stateRepository->changeState($request->input('stateable_id'), $request->input('stateable_type'));

        return Response::json([
            'status' => true,
            'state' => $model->state,
            'state_text' => EState::getTrans($model->state),
        ]);
    }
}
