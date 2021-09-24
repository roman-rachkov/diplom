@props(['comment'])

<div class="Comment">
    <div class="Comment-column Comment-column_pict">
        <div class="Comment-avatar">
        </div>
    </div>
    <div class="Comment-column">
        <header class="Comment-header">
            <div>
                <strong class="Comment-title">{{$comment->user->name}}</strong>
                <span class="Comment-date">{{ $comment->comment_date }}</span>
            </div>
        </header>
        <div class="Comment-content">{{$comment->review}}</div>
    </div>
</div>