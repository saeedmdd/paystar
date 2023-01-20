<?php

namespace App\Services\PaymentServices;

interface PaymentServiceInterface
{
    public function setBaseUrl(string $baseUrl);
    public function setGateway(string $gatewayId);

    public function setSignature(string $signature);

    public function setCallback(string $callback);

    public function create(float $amount, int $orderId);

    public function generatePaymentUrl(string $token);
}
