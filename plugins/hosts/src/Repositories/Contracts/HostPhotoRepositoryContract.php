<?php namespace WebEd\Plugins\Hosts\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface HostPhotoRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createHostPhoto(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateHostPhoto($id, array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateHostPhoto($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteHostPhoto($id);
}
