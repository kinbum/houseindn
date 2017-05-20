<?php namespace WebEd\Plugins\Hosts\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Hosts\Repositories\Contracts\HostRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class HostRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements HostRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createHost(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateHost($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateHost($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteHost($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
