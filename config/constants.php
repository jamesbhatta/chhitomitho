<?php

return [
    'user' => [
        'image_dir' => 'users',
        'items_per_pages' => 15,
    ],

    'product' => [
        'image_dir' => 'products',
        'items_per_page' => 10,
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

];
