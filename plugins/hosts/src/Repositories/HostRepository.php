<?php namespace WebEd\Plugins\Hosts\Repositories;

use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;
use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;

use WebEd\Plugins\Hosts\Repositories\Contracts\HostRepositoryContract;

class HostRepository extends EloquentBaseRepository implements HostRepositoryContract, CacheableContract
{
    use Cacheable;

    /**
     * @param array $data
     * @return int
     */
    public function createHost(array $data)
    {
        return $this->create($data);
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateHost($id, array $data)
    {
        return $this->createOrUpdate($id, $data);
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateHost($id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteHost($id)
    {
        return $this->delete($id);
    }
}
