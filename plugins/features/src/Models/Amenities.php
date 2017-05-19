<?php namespace WebEd\Plugins\Features\Models;

use WebEd\Plugins\Features\Models\Contracts\AmenitiesModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class Amenities extends BaseModel implements AmenitiesModelContract
{
    protected $table = 'amenities';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'label',
        'description',
        'icon',
        'types',
        'created_by',
        'updated_by',
    ];

    public $timestamps = false;
}
