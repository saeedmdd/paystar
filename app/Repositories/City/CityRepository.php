<?php

namespace App\Repositories\City;

use App\Models\City;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    public function __construct(City $model)
    {
        $this->model = $model;
    }

}
