<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductOrderRequest;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\Order\OrderRepository;
use App\Repositories\OrderItem\OrderItemRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\OrderHandlerService;
use App\Services\Product\PriceCalculatorService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $productRepository, protected OrderItemRepository $orderItemRepository, protected OrderHandlerService $orderHandlerService)
    {
    }


    public function index()
    {
        $products = $this->productRepository->paginate(orderedColumn: "updated_at", direction: "desc");
        return view("web.product.index", compact('products'));
    }


    public function order(ProductOrderRequest $request, Product $product)
    {
        $order = $this->orderHandlerService->handle($product, $request->quantity);
        $this->orderItemRepository->updateOrCreate($order->id, $product, $request->quantity);
        return redirect()->route("product.index")->with("message", "Order created successfully");
    }
}
