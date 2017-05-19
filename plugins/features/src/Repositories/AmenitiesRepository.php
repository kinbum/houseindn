<?php namespace WebEd\Plugins\Features\Repositories;

use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;
use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;

use WebEd\Plugins\Features\Repositories\Contracts\AmenitiesRepositoryContract;

class AmenitiesRepository extends EloquentBaseRepository implements AmenitiesRepositoryContract, CacheableContract
{
    use Cacheable;

    /**
     * @param array $data
     * @return int
     */
    public function createAmenities(array $data)
    {
        return $this->create($data, true);
    }

    /**
     * @param int|null|BaseModelContract $id
     * @param array $data
     * @return int
     */
    public function updateAmenities($id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * @param int|BaseModelContract|array $id
     * @return bool
     */
    public function deleteAmenities($id)
    {
        return $this->delete($id);
    }


    /**
     * @param array $params
     * @return mixed
     */
    public function getAmenities(array $params)
    {
        $params = array_merge([
            'order_by' => [
                'order' => 'ASC',
                'created_at' => 'DESC',
            ],
            'take' => null,
            'paginate' => [
                'per_page' => 10,
                'current_paged' => 1
            ],
            'select' => ['*'],
        ], $params);

        $model = $model->select($params['select']);

        foreach ($params['order_by'] as $column => $direction) {
            $model = $model->orderBy($column, $direction);
        }

        if ($params['take'] == 1) {
            return $model->first();
        }

        if ($params['take']) {
            return $model->take($params['take'])->get();
        }

        if ($params['paginate']['per_page']) {
            return $model->paginate($params['paginate']['per_page'], ['*'], 'page', $params['paginate']['current_paged']);
        }

        return $model->get();
    }
}
