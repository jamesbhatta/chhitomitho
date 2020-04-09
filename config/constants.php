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
        'processing'    => 'Processing',
        'shipped'   => 'Shipped',
        'completed'   => 'Completed',
        'cancelled'   => 'Cancelled',
    ],

    'my_orders' => [
        'items_per_page' => '5',
    ],

];
