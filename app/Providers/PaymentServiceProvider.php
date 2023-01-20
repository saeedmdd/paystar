<?php

namespace App\Providers;

use App\Services\PaymentServices\PaymentServiceInterface;
use App\Services\PaymentServices\PayStar\PaystarPaymentService;
use Exception;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PaymentServiceInterface::class, function ($app){
            if (config("payment.driver") == "paystar")
                return new PaystarPaymentService();

            throw new Exception("The payment provider is not valid");
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
