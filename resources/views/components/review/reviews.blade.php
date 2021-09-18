@props(['reviews'])

<div class="Tabs-block" id="reviews">

    <div class="Comments">
        @foreach($reviews as $comment)
            <x-review.comment :comment="$comment"/>
        @endforeach
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
