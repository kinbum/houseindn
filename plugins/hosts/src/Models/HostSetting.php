<?php namespace WebEd\Plugins\Hosts\Models;

use WebEd\Plugins\Hosts\Models\Contracts\HostSettingModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class HostSetting extends BaseModel implements HostSettingModelContract
{
    protected $table = 'host_settings';

    protected $primaryKey = 'id';

    protected $fillable = [];

    public $timestamps = false;
}
