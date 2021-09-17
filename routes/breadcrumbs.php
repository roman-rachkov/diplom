<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

Breadcrumbs::for('banners', fn (Trail $trail) =>
$trail->push(__('breadcrumbs.home'), route('banners'))
);

Breadcrumbs::for('login', fn (Trail $trail) =>
    $trail->parent('banners')->push(__('breadcrumbs.login'), route('login'))
);

Breadcrumbs::for('register', fn (Trail $trail) =>
    $trail->parent('banners')->push(__('breadcrumbs.register'), route('register'))
);

Breadcrumbs::for('password.request', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.password_request'), route('password.request'))
);

Breadcrumbs::for('password.reset', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.password_reset'), route('password.reset'))
);

Breadcrumbs::for('orders.create', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.orders'), route('orders.create'))
);

Breadcrumbs::for('cart.index', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.cart'))
);

Breadcrumbs::for('discounts.index', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.discounts'), route('discounts.index'))
);

Breadcrumbs::for('products.index', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.products'), route('products.index'))
);

Breadcrumbs::for('feedbacks.create', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.feedbacks'), route('feedbacks.create'))
);

Breadcrumbs::for('comparison', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.comparison'), route('comparison'))
);

Breadcrumbs::for('about', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.about'), route('about'))
);

Breadcrumbs::for('account.show', fn (Trail $trail) =>
$trail->parent('banners')->push(__('breadcrumbs.account'), route('account.show'))
);

