<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Transaction\TransactionRepository;
use App\Services\PaymentServices\PaymentServiceInterface;

class OrderController extends Controller
{

    public function __construct(protected OrderRepository $orderRepository, protected TransactionRepository $transactionRepository)
    {
    }

    public function index()
    {
        $orders = $this->orderRepository->userPaginate(relations: "orderItems", orderedColumn: "updated_at", direction: "desc");
        return view('web.order.index', compact("orders"));
    }

    public function pay(Order $order, PaymentServiceInterface $paymentService)
    {
        $result = $paymentService->create($order->final_price, $order->id);
        if ($result["status"] == 1)
            $this->transactionRepository->create([
                "user_id" => auth()->id(),
                "order_id" => $order->id,
                "token" => $result["data"]["token"],
                "provider" =>config("payment.driver"),
                "ref_number" => $result["data"]["ref_num"]
            ]);

        return redirect($paymentService->generatePaymentUrl($result["data"]["token"]));
    }

    public function callback()
    {
        return request()->all();
    }
}
