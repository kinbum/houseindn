<?php namespace WebEd\Plugins\Features\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Features\Repositories\Contracts\AssetRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class AssetRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements AssetRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createAsset(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateAsset($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteAsset($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
