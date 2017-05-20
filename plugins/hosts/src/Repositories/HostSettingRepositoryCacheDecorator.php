<?php namespace WebEd\Plugins\Hosts\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Hosts\Repositories\Contracts\HostSettingRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class HostSettingRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements HostSettingRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createHostSetting(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateHostSetting($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateHostSetting($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteHostSetting($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
