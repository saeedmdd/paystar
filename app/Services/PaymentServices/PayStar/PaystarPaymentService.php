<?php

namespace App\Services\PaymentServices\PayStar;

use App\Services\PaymentServices\PaymentServiceInterface;
use Illuminate\Support\Facades\Http;

class PaystarPaymentService implements PaymentServiceInterface
{
    protected string $baseUrl;
    protected string $gatewayId;
    protected string $signature;
    protected string $callback;

    public function __construct()
    {
        $this->setBaseUrl(config("payment.paystar.base_url"));
        $this->setGateway(config("payment.paystar.gateway_id"));
        $this->setSignature(config("payment.paystar.signature"));
        $this->setCallback(config("payment.paystar.callback"));
    }

    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function setGateway(string $gatewayId)
    {
        $this->gatewayId = $gatewayId;
    }

    public function setSignature(string $signature)
    {
        $this->signature = $signature;
    }

    public function setCallback(string $callback)
    {
        $this->callback = $callback;
    }

    public function create(float $amount, int $orderId)
    {
        return Http::withToken($this->gatewayId)->acceptJson()->post($this->baseUrl."create",[
            "amount" => $amount,
            "order_id" => $orderId,
            "callback" => $this->callback
        ])->collect();
    }

    public function generatePaymentUrl(string $token)
    {
        return $this->baseUrl."payment?token={$token}";
    }
}
