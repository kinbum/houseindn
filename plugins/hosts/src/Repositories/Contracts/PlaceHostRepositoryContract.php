<?php namespace WebEd\Plugins\Hosts\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface PlaceHostRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createPlaceHost(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function createOrUpdatePlaceHost($id, array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updatePlaceHost($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deletePlaceHost($id);
}
