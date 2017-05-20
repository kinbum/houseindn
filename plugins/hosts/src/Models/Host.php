<?php namespace WebEd\Plugins\Hosts\Models;

use WebEd\Plugins\Hosts\Models\Contracts\HostModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class Host extends BaseModel implements HostModelContract
{
    protected $table = 'hosts';

    protected $primaryKey = 'id';

    protected $fillable = [];
}
