<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Order\OrderRepository;

class PriceCalculatorService
{

    public function __construct(protected OrderRepository $orderRepository)
    {
    }

    public function calculate(Product $product, int $quantity): int
    {
        $order = $this->orderRepository->unSubmittedUserOrders();
        return !$order ? $product->price * $quantity : ($product->price * $quantity) + $order->final_price;
    }
}
