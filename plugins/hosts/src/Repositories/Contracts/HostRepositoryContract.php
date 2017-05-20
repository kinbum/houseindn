<?php namespace WebEd\Plugins\Hosts\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface HostRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createHost(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateHost($id, array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateHost($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteHost($id);
}
