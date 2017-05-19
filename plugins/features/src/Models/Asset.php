<?php namespace WebEd\Plugins\Features\Models;

use WebEd\Plugins\Features\Models\Contracts\AssetModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class Asset extends BaseModel implements AssetModelContract
{
    protected $table = 'assets';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'created_by',
    ];

    public $timestamps = false;
}
