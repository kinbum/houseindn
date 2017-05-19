<?php namespace WebEd\Plugins\Features\Repositories;

use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;
use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;

use WebEd\Plugins\Features\Repositories\Contracts\KindRepositoryContract;

class KindRepository extends EloquentBaseRepository implements KindRepositoryContract, CacheableContract
{
    use Cacheable;

    /**
     * @param array $data
     * @return int
     */
    public function createKind(array $data)
    {
        return $this->create($data);
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateKind($id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteKind($id)
    {
        return $this->delete($id);
    }
}
