<?php

namespace App\Models\SilverLink;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SilverLink extends BaseModel
{
    use HasFactory,
        SilverLinkRelationships,
        SilverLinkScopes,
        SilverLinkModifiers;

    protected $table = 'silver_links';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $dates = [];

    protected $fillable = [
        'id',
        'app_type',
        'silver',
        'state',
        'created_at',
        'used_at',
    ];
}
