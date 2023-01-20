<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        $this->model = $model;
    }


    /**
     * @param array|string $columns
     * @param array|string $relations
     * @return null|Model
     */
    public function unSubmittedUserOrders(array|string $columns = ["*"], array|string $relations = []): ?Model
    {
        $orders = $this->setBuilder($relations)
            ->whereNull("submitted_at")
            ->where("user_id", auth()->id())
            ->get($columns);

        return $orders->isEmpty() ? null : $orders->firstOrFail();
    }

    /**
     * @param array|string $columns
     * @param array|string $relations
     * @param int $paginate
     * @param string $pageName
     * @param int|null $page
     * @param string|null $orderedColumn
     * @param string $direction
     * @return LengthAwarePaginator
     */
    public function userPaginate(array|string $columns = ["*"], array|string $relations = [], int $paginate = 15, string $pageName = 'page', int|null $page = null, string $orderedColumn = null, string $direction = "asc"): LengthAwarePaginator
    {
        $builder = $this->setBuilder($relations)->where("user_id", auth()->id());
        return !is_null($orderedColumn) ? $builder->orderBy($orderedColumn, $direction)->paginate($paginate, $columns, $pageName, $page) : $builder->paginate($paginate, $columns, $pageName, $page);

    }
}
