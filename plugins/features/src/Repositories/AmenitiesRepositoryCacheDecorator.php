<?php namespace WebEd\Plugins\Features\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Features\Repositories\Contracts\AmenitiesRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class AmenitiesRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements AmenitiesRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createAmenities(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateAmenities($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteAmenities($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
