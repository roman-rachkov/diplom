<header class="Header">

    @include('layout.header.control_panel')

    @include('layout.header.main_menu')

    @include('layout.header.categories_menu')

    @includeWhen(request()->routeIs('main') ,'layout.banners')

</header>
