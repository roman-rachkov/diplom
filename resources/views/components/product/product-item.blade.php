@props(['product', 'avgPrice', 'avgDiscountPrice', 'discount'])

<div class="Product">
    <div class="ProductCard">
        <div class="ProductCard-look">
            <div class="ProductCard-photo">
                <div class="ProductCard-sale">-{{ $discount }}%
                </div><img src={{$product->image->getRelativeUrlAttribute()}} alt={{$product->image->alt}}/>
            </div>
            <x-product.product-item-images :images="$product->attachment"/>
        </div>
        <div class="ProductCard-desc">
            <div class="ProductCard-header">
                <h2 class="ProductCard-title">{{$product->name}}</h2>
                <div class="ProductCard-info">
                    <div class="ProductCard-cost">
                        <div class="ProductCard-price">${{ $avgDiscountPrice }}</div>
                        <div class="ProductCard-priceOld">${{ $avgPrice }}</div>
                    </div>
                    <form class="ProductCard-compare" method="post" action="{{route('product.addToComparison', ['slug' => $product->slug])}}">
                        @csrf
                        <button type="submit" class="btn btn_default">
                            <img class="btn-icon" src={{asset("assets/img/icons/card/change.svg")}} alt="change.svg"/>
                        </button>
                    </form>
                </div>
            </div>
            <div class="ProductCard-text">
                {{$product->description}}
            </div>
            <form class="ProductCard-cart" method="post" action="{{route('product.addToCart', ['slug' => $product->slug])}}">
                @csrf
                <div class="ProductCard-cartElement ProductCard-cartElement_amount">
                    <div class="Amount Amount_product">
                        <button class="Amount-remove" type="button"></button>
                        <input class="Amount-input form-input" name="amount" type="text" value="1"/>
                        <button class="Amount-add" type="button"></button>
                    </div>
                </div>
                <div class="ProductCard-cartElement">
                    <button class="btn btn_primary" type="submit" >
                        <img class="btn-icon" src={{asset("assets/img/icons/card/cart_white.svg")}} alt="cart_white.svg"/>
                        <span class="btn-content">{{__('product.buy_btn')}}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="Tabs Tabs_default">
        <div class="Tabs-links">
            <a class="Tabs-link_ACTIVE Tabs-link" href="#description">
                <span>{{__('product.tabs_links.description')}}</span>
            </a>
            <a class="Tabs-link" href="#sellers">
                <span>{{__('product.tabs_links.sellers')}}</span>
            </a>
            <a class="Tabs-link" href="#addit">
                <span>{{__('product.tabs_links.addit')}}</span>
            </a>
            <a class="Tabs-link" href="#reviews">
                <span>{{__('product.tabs_links.reviews')}} (3)</span>
            </a>
        </div>
        <div class="Tabs-wrap">
            <div class="Tabs-block" id="description">
                <h2>Megano Store Hystory
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetuer&#32;
                    <strong>adipiscing
                    </strong>&#32;elit doli. Aenean commodo ligula eget dolor. Aenean massa.&#32;<a href="#">Cumtipsu</a>&#32;sociis natoque penatibus et magnis dis parturient montesti, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eutu, pretiumem.
                </p><img class="pict pict_right" src={{asset("assets/img/content/home/bigGoods.png")}} alt="bigGoods.png"/>
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetuer
                    </li>
                    <li>adipiscing elit doli.&#32;<em>Aenean</em>&#32;commodo ligula
                    </li>
                    <li>eget dolor. Aenean massa. Cumtipsu sociis
                    </li>
                    <li>natoque penatibus et magnis dis parturient
                    </li>
                    <li>montesti, nascetur ridiculus mus. Donec
                    </li>
                    <li>quam felis, ultricies nec, pellentesque eutu
                    </li>
                </ul>
                <div class="clearfix">
                </div>
                <div class="table">
                    <table>
                        <tr>
                            <th>Табличка внутри описания</th>
                            <th>Значение
                            </th>
                        </tr>
                        <tr>
                            <td>ываыв</td>
                            <td>llslssl
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <x-product.product-item-sellers :product="$product" :prices="$product->prices"/>
            <div class="Tabs-block" id="addit">
                <div class="Product-props">
                    <div class="Product-prop">
                        <strong>Lorem
                        </strong><span> Pfizer</span>
                    </div>
                    <div class="Product-prop">
                        <strong>ipsum
                        </strong><span> Lorem ipsum dolor sit</span>
                    </div>
                    <div class="Product-prop">
                        <strong>dolor sit
                        </strong><span> 5 ans</span>
                    </div>
                    <div class="Product-prop">
                        <strong>psum dolo
                        </strong><span> 2–3 jours</span>
                    </div>
                </div>
            </div>
            <div class="Tabs-block" id="reviews">
                <div class="Comments">
                    <div class="Comment">
                        <div class="Comment-column Comment-column_pict">
                            <div class="Comment-avatar">
                            </div>
                        </div>
                        <div class="Comment-column">
                            <header class="Comment-header">
                                <div>
                                    <strong class="Comment-title">Alexandra Brownie
                                    </strong><span class="Comment-date">22:50 - 25 Декабря 2020</span>
                                </div>
                            </header>
                            <div class="Comment-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis parturient montesti, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eutu, pretiumem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justotuio, rhoncus ut loret, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus element semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae.
                            </div>
                        </div>
                    </div>
                </div>
                <header class="Section-header Section-header_product">
                    <h3 class="Section-title">{{__('product.tabs_addComment.submit_comment')}}</h3>
                </header>
                <div class="Tabs-addComment">
                    <form class="form" action="#" method="post">
                        <div class="form-group">
                            <textarea class="form-textarea" name="review" id="review" placeholder="{{__('product.tabs_addComment.review_placeholder')}}"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="row-block">
                                    <input class="form-input" id="name" name="name" type="text" placeholder="{{__('product.tabs_addComment.name_placeholder')}}"/>
                                </div>
                                <div class="row-block">
                                    <input class="form-input" id="email" name="email" type="text" placeholder="{{__('product.tabs_addComment.email_placeholder')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn_muted" type="submit">{{__('product.tabs_addComment.submit_comment')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
