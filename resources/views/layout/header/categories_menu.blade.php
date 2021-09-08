<div class="Header-searchWrap">
    <div class="wrap">
        <div class="Header-categories">
            <x-category.category-list />
        </div>
        <div class="Header-searchLink"><img src="{{asset('assets/img/icons/search.svg')}}" alt="search.svg"/>
        </div>
        <div class="Header-search">
            <div class="search">
                <form class="form form_search" action="#" method="post">
                    <input class="search-input" id="query" name="query" type="text" placeholder="Найти..."/>
                    <button class="search-button" type="submit" name="search" id="search"><img src="{{asset('assets/img/icons/search.svg')}}" alt="search.svg"/>Поиск</button>
                </form>
            </div>
        </div>
    </div>
</div>
