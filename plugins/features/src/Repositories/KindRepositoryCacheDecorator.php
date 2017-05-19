<?php namespace WebEd\Plugins\Features\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Features\Repositories\Contracts\KindRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class KindRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements KindRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createKind(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateKind($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteKind($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
