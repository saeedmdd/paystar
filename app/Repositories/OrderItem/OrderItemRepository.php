<?php

namespace App\Repositories\OrderItem;

use App\Models\OrderItem;
use App\Repositories\BaseRepository;

class OrderItemRepository extends BaseRepository
{
    public function __construct(OrderItem $model)
    {
        $this->model = $model;
    }

}
