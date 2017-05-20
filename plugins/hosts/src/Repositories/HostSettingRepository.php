<?php namespace WebEd\Plugins\Hosts\Repositories;

use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;
use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;

use WebEd\Plugins\Hosts\Repositories\Contracts\HostSettingRepositoryContract;

class HostSettingRepository extends EloquentBaseRepository implements HostSettingRepositoryContract, CacheableContract
{
    use Cacheable;

    /**
     * @param array $data
     * @return int
     */
    public function createHostSetting(array $data)
    {
        return $this->create($data);
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateHostSetting($id, array $data)
    {
        return $this->createOrUpdate($id, $data);
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateHostSetting($id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteHostSetting($id)
    {
        return $this->delete($id);
    }
}
