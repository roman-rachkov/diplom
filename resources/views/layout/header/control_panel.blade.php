<div class="ControlPanel">
    <div class="wrap">
        <div class="row ControlPanel-row">
            <div class="row-block">
                <div class="row ControlPanel-rowSplit">
                    <div class="row-block"><a class="ControlPanel-title" href="{{route('discounts.index')}}">Скидки</a>
                    </div>
                    <div class="row-block hide_700"><span class="ControlPanel-title">Мы в соцсетях</span>
                        <ul class="menu menu_img menu_smallImg ControlPanel-menu">
                            <li class="menu-item"><a class="menu-link" href="#"><img src="{{asset('assets/img/icons/socialHeader/fb.svg')}}" alt="fb.svg"/></a></li>
                            <li class="menu-item"><a class="menu-link" href="#"><img src="{{asset('assets/img/icons/socialHeader/tw.svg')}}" alt="tw.svg"/></a></li>
                            <li class="menu-item"><a class="menu-link" href="#"><img src="{{asset('assets/img/icons/socialHeader/in.svg')}}" alt="in.svg"/></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <nav class="row-block">
                <div class="row ControlPanel-rowSplit">
                    <div class="row-block">
                        @guest
                            <a class="ControlPanel-title" href="login.html">Войти</a>&nbsp;/&nbsp;<a class="ControlPanel-title" href="register.html">Регистрация</a>
                        @else
                            <a class="ControlPanel-title" href="{{route('account.show')}}">Профиль</a>&nbsp;/&nbsp;<a class="ControlPanel-title" href="logout.html">Выход</a>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
