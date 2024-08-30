<?php

namespace App\Models\LoginToken;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginToken extends BaseModel
{
    use HasFactory,
        SoftDeletes,
        LoginTokenRelationships,
        LoginTokenScopes,
        LoginTokenModifiers;

    protected $table = 'login_tokens';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'bigo_id',
        'token',
        'type',
        'status',
        'state',
        'extra',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'extra' => 'array'
    ];
}
