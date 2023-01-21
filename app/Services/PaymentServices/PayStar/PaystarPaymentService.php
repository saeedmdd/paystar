<?php

namespace App\Services\PaymentServices\PayStar;

use App\Services\PaymentServices\PaymentServiceInterface;
use Illuminate\Support\Collection;
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

    /**
     * @param string $baseUrl
     * @return void
     */
    public function setBaseUrl(string $baseUrl): void
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param string $gatewayId
     * @return void
     */
    public function setGateway(string $gatewayId): void
    {
        $this->gatewayId = $gatewayId;
    }

    /**
     * @param string $signature
     * @return void
     */
    public function setSignature(string $signature): void
    {
        $this->signature = $signature;
    }

    /**
     * @param string $callback
     * @return void
     */
    public function setCallback(string $callback): void
    {
        $this->callback = $callback;
    }

    /**
     * @param float $amount
     * @param int $orderId
     * @return Collection
     */
    public function create(float $amount, int $orderId): Collection
    {
        return Http::withToken($this->gatewayId)->acceptJson()->post($this->baseUrl."create",[
            "amount" => $amount,
            "order_id" => $orderId,
            "callback" => $this->callback
        ])->collect();
    }

    /**
     * @param string $token
     * @return string
     */
    public function generatePaymentUrl(string $token): string
    {
        return $this->baseUrl."payment?token={$token}";
    }
}
