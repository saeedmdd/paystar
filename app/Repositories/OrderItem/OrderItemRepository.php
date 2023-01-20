<?php

namespace App\Repositories\OrderItem;

use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderItemRepository extends BaseRepository
{
    public function __construct(OrderItem $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $orderId
     * @param Product $product
     * @param int $quantity
     * @return Model|Builder
     */
    public function updateOrCreate(int $orderId, Product $product, int $quantity): Model|Builder
    {
        $orderItem = $this->model
            ->query()
            ->where("user_id", auth()->id())
            ->where("order_id", $orderId)
            ->where("product_id", $product->id)
            ->first();

        if (!$orderItem)
            return parent::create([
                "order_id" => $orderId,
                "product_id" => $product->id,
                "user_id" => auth()->id(),
                "price" => ($product->price * $quantity),
                "quantity" => $quantity
            ]);

        parent::update($orderItem, ["quantity" => $quantity,
            "price" => ($product->price * $quantity) + $orderItem->price,
            "quantity" => $quantity + $orderItem->quantity
        ]);
        return $orderItem;
    }
}
