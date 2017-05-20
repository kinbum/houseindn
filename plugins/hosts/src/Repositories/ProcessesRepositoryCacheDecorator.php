<?php namespace WebEd\Plugins\Hosts\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Plugins\Hosts\Repositories\Contracts\ProcessesRepositoryContract;
use WebEd\Base\Models\Contracts\BaseModelContract;

class ProcessesRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements ProcessesRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createProcesses(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdateProcesses($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateProcesses($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteProcesses($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
