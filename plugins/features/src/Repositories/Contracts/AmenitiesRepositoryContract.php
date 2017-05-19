<?php namespace WebEd\Plugins\Features\Repositories\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;

interface AmenitiesRepositoryContract
{
    /**
     * @param array $data
     * @return int
     */
    public function createAmenities(array $data);

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateAmenities($id, array $data);

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteAmenities($id);
}
