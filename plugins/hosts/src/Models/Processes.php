<?php namespace WebEd\Plugins\Hosts\Models;

use WebEd\Plugins\Hosts\Models\Contracts\ProcessesModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class Processes extends BaseModel implements ProcessesModelContract
{
    protected $table = 'processes';

    protected $primaryKey = 'id';

    protected $fillable = [];

    public $timestamps = false;
}
