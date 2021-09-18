@props(['reviews'])

<div class="Tabs-block" id="reviews">

    <div class="Comments">
        @foreach($reviews as $comment)
            <div class="Comment">
                <div class="Comment-column Comment-column_pict">
                    <div class="Comment-avatar">
                    </div>
                </div>
                <div class="Comment-column">
                    <header class="Comment-header">
                        <div>
                            <strong class="Comment-title">{{$comment->user->name}}
                            </strong><span class="Comment-date">22:50 - 25 Декабря 2020</span>
                        </div>
                    </header>
                    <div class="Comment-content">{{$comment->text}}</div>
                </div>
            </div>
        @endforeach
    </div>
    <header class="Section-header Section-header_product">
        <h3 class="Section-title">Оставить отзыв</h3>
    </header>
    <div class="Tabs-addComment">
        <form class="form" action="#" method="post">
            <div class="form-group">
                <textarea class="form-textarea" name="review" id="review" placeholder="Ваш комментарий..."></textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="row-block">
                        <input class="form-input" id="name" name="name" type="text" placeholder="Ваше Имя"/>
                    </div>
                    <div class="row-block">
                        <input class="form-input" id="email" name="email" type="text" placeholder="Ваш Email"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn_muted" type="submit">Оставить отзыв</button>
            </div>
        </form>
    </div>
</div>
