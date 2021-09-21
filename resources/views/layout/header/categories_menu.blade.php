<div class="Header-searchWrap">
    <div class="wrap">
        <div class="Header-categories">
            <x-category.category-list />
        </div>
        <div class="Header-searchLink"><img src="{{asset('assets/img/icons/search.svg')}}" alt="search.svg"/>
        </div>
        <div class="Header-search">
            <div class="search">
                <form class="form form_search" action="#" method="get">
                    <input class="search-input" id="query" name="search" type="text" placeholder="{{ __('catalog.filter.product_title') }}"/>
                    <button class="search-button" type="submit" name="submit" id="search"><img src="{{asset('assets/img/icons/search.svg')}}" alt="search.svg"/>{{ __('catalog.filter.search') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
