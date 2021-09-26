@props(['reviews', 'product'])

<div class="Tabs-block" id="reviews">

    <div class="Comments">
        @foreach($reviews as $comment)
            <x-review.comment :comment="$comment"/>
        @endforeach
    </div>
    <a
            type="button"
            class="Tabs-link Add-reviews"
            href=""
            data-page="{{$reviews->currentPage()}}"
            data-route="{{route('product.addReviewsToView', ['product' => $product])}}"
    >{{__('product.tabs_addComment.show_more_btn')}}
    </a>
    @auth
        <header class="Section-header Section-header_product">
            <h3 class="Section-title">{{__('product.tabs_addComment.submit_comment')}}</h3>
        </header>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endauth
    @guest
        <div class="row row_space">
            <a class="menu-link" href="{{route('register')}}">
                <span>{{__('product.tabs_addComment.guest_link_to_register')}}</span>
            </a>
        </div>
    @endguest

    @auth
        <div class="Tabs-addComment">
            <form class="form" action="{{route('review.store', ['product' => $product])}}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <textarea class="form-textarea" name="review" id="review" placeholder="{{__('product.tabs_addComment.review_placeholder')}}"/></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="row-block">
                            <input
                                class="form-input"
                                id="name"
                                name="name"
                                type="text"
                                placeholder="{{auth()->user()->name}}"
                            />
                        </div>
                        <div class="row-block">
                            <input
                                class="form-input"
                                id="email"
                                name="email"
                                type="text"
                                placeholder="{{auth()->user()->email}}"
                            />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn_muted" type="submit">{{__('product.tabs_addComment.submit_comment')}}</button>
                </div>
            </form>
        </div>
    @endauth
</div>
