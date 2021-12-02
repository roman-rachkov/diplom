<div class="Section-columnContent">
    <ul class="menu menu_vt Order-navigate">
        <li class="{{!request()->routeIs('order.confirm')? 'menu-item_ACTIVE' : ''}} menu-item">
            <a class="menu-link" href="#step1">
                {{__('checkout.step1')}}
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="#step2">
                {{__('checkout.step2')}}
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="#step3">
                {{__('checkout.step3')}}
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link {{request()->routeIs('order.confirm')? 'menu-item_ACTIVE' : ''}}"
               href="{{route('order.confirm')}}">
                {{__('checkout.step4')}}
            </a>
        </li>
    </ul>
</div>
