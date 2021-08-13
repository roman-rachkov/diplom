
### 1.3 Разработка модели сервисов

|Model|DB table|Services|Repository methods|
|------|------|------|------|
|Banner|banners|Create<br />Destroy<br />Update|getAdminBanners<br />store<br />update<br />delete<br />addImage|
|Category|categories|Create<br />Destroy<br />Update|getAdminCategories<br />store<br />update<br />addImage|
|Delivery|delivery|Update|getAdminDelivery<br />update|
|Discount|discounts|Create<br />Update|getAdminDiscounts<br />getDiscounts<br />find<br />store<br />update<br />addCategory<br />addProductsGroup<br />addProduct|
|Feedback|feedbacks|Create|getAdminFeedbacks<br />update<br />store|
|Image|images|Create<br />Update|-|
|Order|orders|Create<br />Destroy<br />Update|getAdminOrders<br />find<br />store<br />update<br />addItems<br />addDelivery<br />addPayment<br />addUser|
|OrderItem|order_item|Create<br />Destroy<br />Update|-|
|Payment|payments|Create|-|
|Product|products|Create<br />Destroy<br />Update<br />Compare<br />Sort<br />Filter<br />GetDiscounts<br />Import|getProducts <br />getAdminProducts <br />find <br />store <br />update <br />delete<br />addReview<br />addSeller<br />addManufacturer<br />addCategory<br />addMainImage<br />addGalleryImage|
|Review|reviews|Create<br />Destroy<br />Update|getAdminReviews<br />store|
|Seller|sellers|Import|store<br />update|
|User|users|Create<br />Destroy<br />Update|getAdminUsers<br />find<br />store<br />update<br />delete<br />getViewedProducts<br />getOrderHistory|
|ViewedProduct|viewed_products|Create|-|
|Manufacturer|manufacturers|-|-|
