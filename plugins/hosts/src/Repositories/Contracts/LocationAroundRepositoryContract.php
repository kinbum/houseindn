<?php namespace WebEd\Plugins\Hosts\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface LocationAroundRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createLocationAround(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateLocationAround($id, array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateLocationAround($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteLocationAround($id);
}
