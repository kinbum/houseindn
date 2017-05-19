<?php namespace WebEd\Plugins\Features\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface AssetRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createAsset(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateAsset($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteAsset($id);
}
