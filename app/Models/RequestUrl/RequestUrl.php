<?php

namespace App\Models\RequestUrl;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestUrl extends BaseModel
{
    use HasFactory,
        SoftDeletes,
        RequestUrlRelationships,
        RequestUrlScopes,
        RequestUrlModifiers;

    protected $table = 'request_urls';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'url',
        'state',
        'count_of_used',
        'used_at',
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
