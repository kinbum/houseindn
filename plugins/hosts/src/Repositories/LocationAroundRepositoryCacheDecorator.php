<?php namespace WebEd\Plugins\Hosts\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Hosts\Repositories\Contracts\LocationAroundRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class LocationAroundRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements LocationAroundRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createLocationAround(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateLocationAround($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateLocationAround($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteLocationAround($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
