<?php

return [
    'user' => [
        'image_dir' => 'users',
        'items_per_page' => 15,
    ],

    'product' => [
        'image_dir' => 'products',
        'items_per_page' => 15,
        ''
    ],
    
    'order' => [
        'items_per_page' => 15,
        ''
    ],

    'ROLES' => [
        'admin' => 'Admin',
        'manager'   => 'Manager',
        'partner'   => 'Partner',
        'courier'   => 'Courier',
        'customer'   => 'Customer',
    ],

    'STATUS'  => [
        'pending_payment' => 'Pending Payment',
        'pending'   => 'Pending',
        'confirmed' => 'Confirmed',
        'processing'    => 'Processing',
        'shipped'   => 'Shipped',
        'delivered'   => 'Delivered',
        'cancelled'   => 'Cancelled',
    ],

    'my_orders' => [
        'items_per_page' => '5',
    ],

    'slider' => [
        'image_dir' => 'sliders',
    ],
    
    'cron_test_mode' => env('CRON_TEST_MODE', true),

];
