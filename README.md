
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
