<footer class="Footer">
    <div class="wrap">
        <div class="row Footer-main">
            <div class="row-block"><a class="logo Footer-logo" href="{{route('banners')}}"><img class="logo-image" src="{{asset('assets/img/logo_footer.png')}}" alt="logo_footer.png"/></a>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid  unt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                </p>
                <ul class="menu menu_img menu_smallImg Footer-menuSoc">
                    <li class="menu-item"><a class="menu-link" href="#"><img src="{{asset('assets/img/icons/socialFooter/fb.svg')}}" alt="fb.svg"/></a></li>
                    <li class="menu-item"><a class="menu-link" href="#"><img src="{{asset('assets/img/icons/socialFooter/tw.svg')}}" alt="tw.svg"/></a></li>
                    <li class="menu-item"><a class="menu-link" href="#"><img src="{{asset('assets/img/icons/socialFooter/in.svg')}}" alt="in.svg"/></a></li>
                </ul>
            </div>
            <div class="row-block">
                <strong class="Footer-title">{{__('footer.Navigation')}}</strong>
                <ul class="menu menu_vt Footer-menu">
                    <li class="menu-item"><a class="menu-link" href="{{route('banners')}}">{{__('footer.Main')}}</a></li>
                    <li class="menu-item"><a class="menu-link" href="{{route('catalog.index')}}">{{__('footer.Catalog')}}</a></li>
                    <li class="menu-item"><a class="menu-link" href="{{route('discounts.index')}}">{{__('footer.Discounts')}}</a></li>
                </ul>
            </div>
            <div class="row-block">
                <strong class="Footer-title">{{__('footer.Additionally')}}</strong>
                <ul class="menu menu_vt Footer-menu">
                    <li class="menu-item"><a class="menu-link" href="{{route('feedbacks.index')}}">{{__('footer.Contacts')}}</a></li>
                    <li class="menu-item"><a class="menu-link" href="{{route('about')}}">{{__('footer.About')}}</a></li>
                </ul>
            </div>
            <div class="row-block">
                <strong class="Footer-title">{{__('footer.Contacts')}}</strong>
                <p>??????: 8-800-200-600<br>{{__('footer.Email')}}: megano@skillbox_diploma.com<br>{{__('footer.Address')}}: ??????????????-??????????????????<br>?????????????????? ????????????, 1</p>
            </div>
        </div>
    </div>
    <div class="Footer-copy">
        <div class="wrap">
            <div class="row row_space">
                <div class="row-block">?? <a href="{{route('banners')}}">Megano.</a>&#32;{{__('footer.Right')}}.</div>
                <div class="row-block"><span>{{__('footer.Payment')}}</span>
                    <div class="Footer-payments">
                        <div><img src="{{asset('assets/img/payments/visa.png')}}" alt="visa.png"/></div>
                        <div><img src="{{asset('assets/img/payments/mastercard.png')}}" alt="mastercard.png"/></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
