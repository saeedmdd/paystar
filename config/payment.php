<?php
return [
    "driver" => env("PAYMENT_PROVIDER"),
    "paystar" => [
        "gateway_id" => env("PAYSTAR_GATEWAY_ID"),
        "signature" => env("PAYSTAR_SIGNATURE"),
        "callback" => env("PAYSTAR_CALLBACK"),
        "base_url" => env("PAYSTAR_BASE_URL")
    ]
];
