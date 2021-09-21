<div class="Section-column">
    <div class="Section-columnSection">
        <header class="Section-header">
            <strong class="Section-title">Навигация</strong>
        </header>
        <div class="Section-columnContent">
            <div class="NavigateProfile">
                <ul class="menu menu_vt">
                    @if(request()->routeIs('users.show'))
                        <li class="menu-item_ACTIVE menu-item"><a class="menu-link" href="{{route('users.show', $user)}}">Личный кабинет</a></li>
                    @else
                        <li class="menu-item"><a class="menu-link" href="{{route('users.show', $user)}}">Личный кабинет</a></li>
                    @endif

                    @if(request()->routeIs('users.edit'))
                        <li class="menu-item_ACTIVE menu-item"><a class="menu-link" href="{{route('users.edit', $user)}}">Профиль</a></li>
                    @else
                        <li class="menu-item"><a class="menu-link" href="{{route('users.edit', $user)}}">Профиль</a></li>
                    @endif

                    <li class="menu-item"><a class="menu-link" href="#">История заказов</a></li>
                    <li class="menu-item"><a class="menu-link" href="#">История просмотра</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
