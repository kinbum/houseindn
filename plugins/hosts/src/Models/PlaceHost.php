<?php namespace WebEd\Plugins\Hosts\Models;

use WebEd\Plugins\Hosts\Models\Contracts\PlaceHostModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class PlaceHost extends BaseModel implements PlaceHostModelContract
{
    protected $table = 'place_host';

    protected $primaryKey = 'id';

    protected $fillable = [];

    public $timestamps = false;
}
