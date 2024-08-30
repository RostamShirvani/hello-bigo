<?php

namespace App\Repositories\API;

use App\Models\User\User;
use Illuminate\Http\Request;

class UserRepository extends BaseAPIRepository
{
    public function __construct(User $model)
    {
        $this->setModel($model);
    }
}
