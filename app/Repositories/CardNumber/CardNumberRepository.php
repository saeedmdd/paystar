<?php

namespace App\Repositories\CardNumber;

use App\Models\CardNumber;
use App\Repositories\BaseRepository;

class CardNumberRepository extends BaseRepository
{
    public function __construct(CardNumber $model)
    {
        $this->model = $model;
    }
}
