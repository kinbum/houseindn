<?php namespace WebEd\Plugins\Hosts\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface HostSettingRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createHostSetting(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateHostSetting($id, array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateHostSetting($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteHostSetting($id);
}
