# Дипломная работа PHP разрабочик с 0 до Pro Часть 3

При разработке использовался Сервис-Репозиторный подход.

Для организации frontend использовались Laraval-компоненты.

Разработка велась с помощью laravel/sail

## Список выполненых основных задач(не считая мелких и багфиксов)
Интеграция страницы о нас

Разработка административного интерфейса

Разработка каталога топ товаров на главной странице

Разработка корзины

Разработка страницы истории заказов

Разработка списка скидок в админке

Разработка контрактов импорта

Разработка сервиса и репозитория скидок

Фабрика ридеров для импорта

### _1. Описание проекта_
<hr style="border:1px solid gray"> </hr>

Разработака интернет-магазина, агрегатора товаров различных продавцов. Проект разработан на фреймворке Laravel (Sail). Для построения приложения использовался сервис-репозиторный подход.
Проект разрабатывался с 15 августа 2021 года по 7 декабря 2021 года.
Все участники выполняли задачи дипломного проекта в условиях полной занятости на основной работе.

Team-lead: <a href="https://github.com/mvsvolkov">mvsvolkov</a>

Команда:
- <a href="https://github.com/Skydescent">Калашников Крилл</a>
- <a href="https://github.com/Tmoiseenko">Тимосеенко Тимур</a>
- <a href="https://github.com/roman-rachkov">Роман Рачков</a>
- <a href="https://github.com/tftp">Олег Голобородько</a>

### _2. Установка приложения_
<hr style="border:2px solid gray"> </hr>
Для запуска приложения необходим <a href="https://docs.docker.com/engine/install/">docker</a> и <a href="https://docs.docker.com/compose/install/">docker-compose</a>

Создаём alias для команды sail:
```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Запускаем контейнер в фоновом режиме:

```
sail up &
```

Устанавливаем зависимости composer:
```
sail composer install
```

Устанавливаем зависимости npm:
```
sail npm install
```

Компилируем скрипты:
```
sail npm run dev
```

Также в проекте есть устновочный скрипт, который выполняет описанные комманды:
```
./install.sh
```

После установки необходимо выполнить миграции и загрузить демо-данные:
```
sail artisan migrate
```
```
sail artisan db:seed \\Database\\Seeders\\DemoDataSeeders\\DemoDataSeeder
```

### 3 Выполненные задачи

<hr style="border:1px solid gray"> </hr>

#### 3.1 Разработка административного интерфейса

https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Orchid/PlatformProvider.php

<hr style="border:1px solid gray"> </hr>

#### 3.2 Разработка каталога топ товаров на главной странице

https://github.com/roman-rachkov/diplom/blob/07ede1522f12254c5fe3cef4841ffb2ddeb8aa78/app/Repository/ProductRepository.php#L107
<hr style="border:1px solid gray"> </hr>

#### 3.3 Разработка корзины, оформления заказа и оплаты
https://github.com/roman-rachkov/diplom/tree/cart_bugfix/app/Service/Cart
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Http/Controllers/CartController.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Rules/PhoneRule.php


https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Repository/OrderRepository.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Repository/OrderItemRepository.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Http/Controllers/OrderController.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Http/Requests/OrderConfirmRequest.php


https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Repository/PaymentsServicesRepository.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Repository/PaymentRepository.php
https://github.com/roman-rachkov/diplom/tree/cart_bugfix/app/Service/Payment
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Jobs/GoPaymentJob.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Http/Controllers/PaymentController.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Http/Requests/PaymentFormRequest.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Rules/PaymentCardRule.php

https://github.com/roman-rachkov/diplom/blob/cart_bugfix/resources/js/backend.js
<hr style="border:1px solid gray"> </hr>

#### 3.4 Разработка страницы истории заказов
https://github.com/roman-rachkov/diplom/tree/cart_bugfix/resources/views/users/history
https://github.com/roman-rachkov/diplom/blob/07ede1522f12254c5fe3cef4841ffb2ddeb8aa78/app/Http/Controllers/UserController.php#L57
<hr style="border:1px solid gray"> </hr>

#### 3.5 Разработка списка скидок в админке
https://github.com/roman-rachkov/diplom/tree/cart_bugfix/app/Orchid/Layouts/Discounts
https://github.com/roman-rachkov/diplom/tree/cart_bugfix/app/Orchid/Screens/Discount
<hr style="border:1px solid gray"> </hr>

#### 3.6 Разработка Сервиса импорта
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Service/Imports/ProductsImportService.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Repository/ImportProductsRepository.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Service/Imports/FakeDataReaderService.php
https://github.com/roman-rachkov/diplom/blob/cart_bugfix/app/Service/Imports/DataReaderFactoryService.php


### 4 Видео-запись защиты диплома

<hr style="border:1px solid gray"> </hr>

[![Дипломная работа](https://img.youtube.com/vi/iZCqdbRobrg/maxresdefault.jpg)](https://www.youtube.com/watch?v=BkLxFcUiJxU&t=3682s)
