<?php

return [

    'api_domain' => env('SCAN2PAY_API_DOMAIN', 'https://a.intella.co'),
    'merchant_id' => env('SCAN2PAY_MERCHANT_ID', ''),
    'trade_key' => env('SCAN2PAY_TRADE_KEY', ''),
    'refund_key' => env('SCAN2PAY_REFUND_KEY', ''),
    'public_key_path' => env('SCAN2PAY_PUBLIC_KEY_PATH', ''),

    'iv' => env('SCAN2PAY_IV', ''),
    'device_id' => env('SCAN2PAY_DEVICE_ID', ''),

    'store_info' => env('SCAN2PAY_STORE_INFO'),
    'cashier' => env('SCAN2PAY_CASHIER'),
    'store_name' => env('SCAN2PAY_STORE_NAME'),
    'store_type' => env('SCAN2PAY_STORE_TYPE'),
    'device_os' => env('SCAN2PAY_DEVICE_OS'),
];
