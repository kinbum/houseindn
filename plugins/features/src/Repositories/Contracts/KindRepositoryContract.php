<?php namespace WebEd\Plugins\Features\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface KindRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createKind(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateKind($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteKind($id);
}
