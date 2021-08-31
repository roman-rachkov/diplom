<?php

return [
        'contact' => [
            [
                'name' => 'Телефон',
                'value' => env('OPTION_PHONE', '+7 (999) 111 11 11'),
            ],
            [
                'name' => 'Адрес',
                'value' => env('OPTION_ADDRESS', 'Москва, ул. Ленина'),
            ],
            [
                'name' => 'Email',
                'value' => env('OPTION_EMAIL', 'help@example.com'),
            ],
        ],
        'delivery' => [
            [
                'name' => 'Доплата за экспресс доставку',
                'value' => env('OPTION_DELIVERY_EXPRESS','500'),
            ],
            [
                'name' => 'Стоимость доставки, если стоимость заказа меньше 2000 рублей',
                'value' => env('OPTION_DELIVERY_PRICE', '200'),
            ],
        ],
        'user' => [
            [
                'name' => 'Максимальный размер аватарки, киллобайт',
                'value' => env('OPTION_USER_AVATAR','2048'),
            ],
            [
                'name' => 'Количество последних просмотров товаров',
                'value' => env('OPTION_USER_VIEWS','20'),
            ],
        ],
];
