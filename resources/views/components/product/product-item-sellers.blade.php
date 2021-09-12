@props(['sellers'])

<div class="Tabs-block" id="sellers">
    <div class="Categories Categories_product">
        @foreach($sellers as $seller)
            <div class="Categories-row">
            <div class="Categories-block Categories-block_info">
                <div class="Categories-info">
                    <strong>{{$seller->name}}</strong>
                </div>
            </div>
            <div class="Categories-splitProps">
            </div>
            <div class="Categories-block Categories-price">
                <strong>€&#32;40.58</strong>
            </div>
            <div class="Categories-block Categories-button"><a class="btn btn_primary" href="#"><img class="btn-icon" src="assets/img/icons/card/cart_white.svg" alt="cart_white.svg"/><span class="btn-content">Купить</span></a>
            </div>
        </div>
        @endforeach
    </div>
</div>
