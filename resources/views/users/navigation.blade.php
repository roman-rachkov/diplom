<div class="Section-column">
    <div class="Section-columnSection">
        <header class="Section-header">
            <strong class="Section-title">{{ __('account_navigation.title') }}</strong>
        </header>
        <div class="Section-columnContent">
            <div class="NavigateProfile">
                <ul class="menu menu_vt">
                    <li class="{{request()->routeIs('users.show') ? 'menu-item_ACTIVE' : ''}} menu-item">
                        <a class="menu-link" href="{{route('users.show', $user)}}">{{ __('account_navigation.account') }}</a>
                    </li>

                    <li class="{{request()->routeIs('users.edit') ? 'menu-item_ACTIVE' : ''}} menu-item">
                        <a class="menu-link" href="{{route('users.edit', $user)}}">{{ __('account_navigation.profile') }}</a>
                    </li>

                    <li class="{{request()->routeIs('users.orders') ? 'menu-item_ACTIVE' : ''}} menu-item">
                        <a class="menu-link" href="{{route('users.orders', $user)}}">{{ __('account_navigation.order_history') }}</a>
                    </li>

                    <li class="{{request()->routeIs('users.viewed_products') ? 'menu-item_ACTIVE' : ''}} menu-item">
                        <a class="menu-link" href="{{route('users.viewed_products', $user)}}">{{ __('account_navigation.viewing_history') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
