<?php namespace WebEd\Plugins\Hosts\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Hosts\Repositories\Contracts\HostPhotoRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class HostPhotoRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements HostPhotoRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createHostPhoto(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateHostPhoto($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateHostPhoto($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteHostPhoto($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
