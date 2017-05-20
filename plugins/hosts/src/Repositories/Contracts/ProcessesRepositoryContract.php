<?php namespace WebEd\Plugins\Hosts\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface ProcessesRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createProcesses(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateProcesses($id, array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateProcesses($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteProcesses($id);
}
