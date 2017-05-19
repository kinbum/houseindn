<?php namespace WebEd\Plugins\Features\Models;

use WebEd\Plugins\Features\Models\Contracts\KindModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class Kind extends BaseModel implements KindModelContract
{
    protected $table = 'kinds';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
    ];

    public $timestamps = false;
}
