<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Order\OrderRepository;
use Illuminate\Database\Eloquent\Model;

class OrderHandlerService
{
    public function __construct(protected PriceCalculatorService $priceCalculatorService, protected OrderRepository $orderRepository)
    {
    }

    /**
     * @param Product $product
     * @param int $quantity
     * @param array|string $columns
     * @param array|string $relations
     * @return Model|null
     */
    public function handle(Product $product, int $quantity, array|string $columns = ["*"], array|string $relations = []): ?Model
    {
        $finalPrice = $this->priceCalculatorService->calculate($product, $quantity);
        $order = $this->orderRepository->unSubmittedUserOrders($columns, $relations);
        if (!$order)
            return $this->orderRepository->create([
                "user_id" => auth()->id(),
                "final_price" => $finalPrice
            ]);

        $this->orderRepository->update($order, ["final_price" => $finalPrice]);

        return $order;
    }

}
