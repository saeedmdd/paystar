<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderSubmitRequest;
use App\Models\Order;
use App\Repositories\CardNumber\CardNumberRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Transaction\TransactionRepository;
use App\Services\PaymentServices\PaymentServiceInterface;

class OrderController extends Controller
{

    public function __construct(protected OrderRepository $orderRepository, protected TransactionRepository $transactionRepository, protected CardNumberRepository $cardNumberRepository)
    {
    }

    public function index()
    {
        $orders = $this->orderRepository->userPaginate(
            relations: "orderItems",
            orderedColumn: "updated_at",
            direction: "desc",
            conditions: ["submitted_at" => null]
        );
        return view('web.order.index', compact("orders"));
    }

    public function failed()
    {

        $orders = $this->orderRepository->userPaginate(
            relations: "orderItems",
            orderedColumn: "updated_at",
            direction: "desc",
            conditions: ["paid_at" => null]
        );
        return view('web.order.index', compact("orders"));
    }

    public function pay(Order $order, PaymentServiceInterface $paymentService, OrderSubmitRequest $request)
    {
        $transaction = $paymentService->create($order->final_price, $order->id);
        $this->cardNumberRepository->findOrCreate($request->card_number);
        if ($transaction["status"] != 1)
            abort(400, "there is a problem with payment provider");
            $this->transactionRepository->create([
                "user_id" => auth()->id(),
                "order_id" => $order->id,
                "token" => $transaction["data"]["token"],
                "provider" => config("payment.driver"),
                "ref_number" => $transaction["data"]["ref_num"]
            ]);
            $this->orderRepository->update($order, ["submitted_at" => now()]);

        return redirect($paymentService->generatePaymentUrl($transaction["data"]["token"]));
    }

    public function callback()
    {
        if (request("status") == -98) {
            $transaction = $this->transactionRepository->findByColumns(["ref_number" => request("ref_num")]);
            $transaction->update([
                "transaction_id" => request("transaction_id"),
                "status" => TransactionRepository::FAILED
            ]);
            $cardNumber = $transaction->user()->first()->cardNumbers()?->first();
            return view("web.transaction.failed", compact("transaction", "cardNumber"));

        }
        if (request("status") == 1) {
            list($userCardNumbers, $cardNumber) = $this->verifyNumber();
            if (!in_array($cardNumber, $userCardNumbers)) {
                $transaction = $this->transactionRepository->findByColumns(["ref_number" => request("ref_num")]);
                $transaction->update([
                    "transaction_id" => request("transaction_id"),
                    "tracking_code" => request("tracking_code"),
                    "card_number" => request("card_number"),
                    "status" => TransactionRepository::FAILED
                ]);
                $cardNumber = $transaction->user()->first()->cardNumbers()?->first();
                return view("web.transaction.number_not_match", compact("cardNumber", "transaction"));
            } else {
                $transaction = $this->transactionRepository->findByColumns(["ref_number" => request("ref_num")]);
                $transaction->update([
                    "transaction_id" => request("transaction_id"),
                    "tracking_code" => request("tracking_code"),
                    "card_number" => request("card_number"),
                    "status" => TransactionRepository::SUCCESSFUL
                ]);
                $this->orderRepository->update($transaction->order, ["paid_at" => now()]);
                return view("web.transaction.success", compact("transaction"));
            }
        }
    }

    /**
     * @return array
     */
    public function verifyNumber(): array
    {
        $userCardNumbers = $this->cardNumberRepository->getAll(conditions: ["user_id" => auth()->id()])->map(function ($item) {
            return substr($item, -4);
        });
        $cardNumber = substr(request("card_number"), -4);
        return array($userCardNumbers, $cardNumber);
    }


}
