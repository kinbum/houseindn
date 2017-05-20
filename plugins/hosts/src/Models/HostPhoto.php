<?php namespace WebEd\Plugins\Hosts\Models;

use WebEd\Plugins\Hosts\Models\Contracts\HostPhotoModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class HostPhoto extends BaseModel implements HostPhotoModelContract
{
    protected $table = 'host_photos';

    protected $primaryKey = 'id';

    protected $fillable = [];

    public $timestamps = false;
}
