<?php

return [
        'contact' => [
            [
                'name' => 'Телефон',
                'variable' => 'contactPhone',
                'value' => '+7 (999) 111 11 11',
            ],
            [
                'name' => 'Адрес',
                'variable' => 'contactAddress',
                'value' => 'Москва, ул. FЛенина',
            ],
            [
                'name' => 'Email',
                'variable' => 'contactEmail',
                'value' => 'help@example.com',
            ],
        ],
        'delivery' => [
            [
                'name' => 'Доплата за экспресс доставку',
                'variable' => 'deliveryExpress',
                'value' => '500',
            ],
            [
                'name' => 'Стоимость доставки, если стоимость заказа меньше 2000 рублей',
                'variable' => 'deliveryPrice',
                'value' => '200',
            ],
        ],
        'user' => [
            [
                'name' => 'Максимальный размер аватарки, киллобайт',
                'variable' => 'usersAvatarSize',
                'value' => '2048',
            ],
            [
                'name' => 'Количество последних просмотров товаров',
                'variable' => 'userViewProductCount',
                'value' => '20',
            ],
        ],
];
