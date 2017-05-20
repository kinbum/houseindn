<?php namespace WebEd\Plugins\Hosts\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Hosts\Repositories\Contracts\PlaceHostRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class PlaceHostRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements PlaceHostRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createPlaceHost(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdatePlaceHost($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updatePlaceHost($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deletePlaceHost($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
