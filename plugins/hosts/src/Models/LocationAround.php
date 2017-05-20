<?php namespace WebEd\Plugins\Hosts\Models;

use WebEd\Plugins\Hosts\Models\Contracts\LocationAroundModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class LocationAround extends BaseModel implements LocationAroundModelContract
{
    protected $table = 'location_arounds';

    protected $primaryKey = 'id';

    protected $fillable = [];

    public $timestamps = false;
}
