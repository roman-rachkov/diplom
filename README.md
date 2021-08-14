## Дипломная работа PHP разрабочик с 0 до Pro Часть 3


### _1.1 Модель хранения данных_

![Alt text](project/shop_schema_ver7.png?raw=true "Модель хранения данных")

В проекте планируется содать следующие модели:
- AdminSettings
- Banner
- Category
- Discount _(Полиморфная связь многие ко многим через таблицу discountable, модели: Category, Product)_
- Delivery
- Feedback
- Image _(Связь один к одному, модели: Seller, User, Category, Banner, Manufacturer; Связь один ко многим и связь один к одному для главного изображения, модель: Product)_
- Order
- OrderItem
- Payment
- Product
- Review
- Seller
- User
- ViewedProduct
- Manufacturer

### _1.2 Cтруктура url на сайте_


| Раздел | Страница | Описание | HTTP метод | Route name| URL | Комментарий |
| ------ | ------ | ------ | ------ | ------ | ------ | ------ |
| Главная | Главная страница | Главный баннер и категории товаров | GET | / | banners |- |
| Каталог | Перечень товаров | Каталог, популярные товары, скидки | GET | /products/ | products.index |- |
| Каталог | Детальная страница | Просмотр страницы товара | GET | /products/\<slug> | products.show |- |
| Каталог | Детальная страница | Форма добавления отзыва | GET | /products/\<slug>/reviews | reviews.create |- |
| Каталог | Детальная страница | Добавление нового отзыва | POST | /products/\<slug>/reviews | reviews.store |- |
| Каталог | Детальная страница | Сравнение товаров | GET | /products/comparison | comparison |id сравниваемых товаров добавляются в сессию и выгружаются из неё при сравнении |
| Страница о продавце | Детальная страница | Просмотр страницы о продавце | GET | /sellers/\<id> | sellers.show |- |
| Страница о скидках  | Перечень скидок | Перечень скидок всех товаров | GET | /discounts | discounts.index |- |
| Страница о скидках  | Детальная страница | Просмотр страницы скидки | GET | /discounts/\<id> | discounts.show |- |
| Оформление заказа | Детальная страница | Редактирование корзины | GET | /cart | carts.edit |- |
| Оформление заказа | Детальная страница | Обновление корзины | PATCH | /cart | carts.update |- |
| Оформление заказа | Детальная страница | Удаление корзины | DELETE | /cart | carts.destroy |удаление корзины из сессии |
| Оформление заказа | Пошаговая форма заказа | Заполнение формы | GET | /orders | orders.create |- |
| Оформление заказа | Пошаговая форма заказа | Нажатие кнопки "Оплатить" | POST | /orders | orders.store |Создание нового заказа, запись корзины в БД в order_items |
| Оформление заказа | Детальная страница оплаты | Редактирование формы опалаты(счёт, способ) | GET | /orders/\<id>/checkin | payments.create |- |
| Оформление заказа | Детальная страница оплаты | Нажатие кнопки "Оплатить" | POST | /orders/\<id>/checkin | payments.store |- |
| Личный кабинет | Детальная страница | Просмотр кабинета | GET | /account | account.show |- |
| Личный кабинет | Детальная страница | Редактирование профиля | GET | /account/profile | account.edit |- |
| Личный кабинет | Детальная страница | Обновление профиля | PATCH | /account/profile | account.update |- |
| Личный кабинет | Детальная страница | История просмотров | GET | /account/viewed-products | account.viewed-products |- |
| Личный кабинет | Детальная страница | История заказов | GET | /account/orders-history | account.order-history |- |
| Контакты | Детальная страница | Страница с контактами и формой обратной связи | GET | /feedbacks | feedbacks.create |- |
| Контакты | Детальная страница | Отправка формы обратной связи | POST | /feedbacks | feedbacks.store |- |
| О нас | Детальная страница | Статичная страница с историей компнаии | GET | /about | about |- |
| Административный раздел | Пользователи | Управление пользователями: CRUD | GET / POST / PATCH / DELETE | /admin/users/... | admin.users. ... |- |
| Административный раздел | Товары | Управление товарами: CRUD | GET / POST / PATCH / DELETE | /admin/products/... | admin.products. ... |- |
| Административный раздел | Заказы | Управление заказами: CRUD | GET / POST / PATCH / DELETE | /admin/orders/... | admin.orders. ... |- |
| Административный раздел | Категории | Управление категориями: CRUD | GET / POST / PATCH / DELETE | /admin/categories/... | admin.categories. ... |- |
| Административный раздел | Отзывы | Управление отзывами: CRUD | GET / POST / PATCH / DELETE | /admin/reviews/... | admin.reviews. ... |- |
| Административный раздел | Баннеры | Управление баннерами: CRUD | GET / POST / PATCH / DELETE | /admin/banners/... | admin.banners. ... |- |
| Административный раздел | Скидки | Управление скидками: CRUD | GET / POST / PATCH / DELETE | /admin/discounts/... | admin.discounts. ... |- |
| Административный раздел | Обращения | Просмотр обращений | GET | /admin/feedbacks | admin.feedbacks.index |- |
| Административный раздел | Форма проведения импорта | Выбор параметорв импорта | GET | /admin/import | admin.import |- |
| Административный раздел | Форма проведения импорта | Нажатие на кнопку "Запустить импорт" | GET | /admin/start-import | admin/start-import |- |

### 1.3 Разработка модели сервисов

|Model|DB table|Services|Repository|
|------|------|------|------|
|AdminSettings|admin_settings|AdminSettingsService|AdminSettingsRepository|
|Banner|banners|-|BannerRepository|
|Category|categories|-|CategoryRepository|
|Delivery|delivery|DeliveryCostService|DeliveryRepository|
|Discount|discounts|-|DiscountRepository|
|Feedback|feedbacks|-|FeedbackRepository|
|Image|images|-|ImageRepository|
|Order|orders|-|OrderRepository|
|OrderItem|order_item|AddToCartService<br />GetCartService|OrderItemRepository|
|Payment|payments|PayOrderService|PaymentRepository|
|Product|products|OfferOfTheDayService<br />CompareProductsService<br />ProductsSortService<br />ProductsFiltersService<br />ProductDiscountService<br />ImportProductService|ProductRepository|
|Review|reviews|AddReviewService|ReviewRepository|
|Seller|sellers|ImportSellerService|SellerRepository|
|User|users|-|UserRepository|
|ViewedProduct|viewed_products|ViewedProductsService|ViewedProductsRepository|
|Manufacturer|manufacturers|-|ManufacturerRepository|
