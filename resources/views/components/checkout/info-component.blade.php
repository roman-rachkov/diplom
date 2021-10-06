@props(['title', 'info', 'type'])
<div class="Order-info">
    <div class="Order-infoType">{{$title}}:</div>
    <div class="Order-infoContent" id="type-{{$type}}">{{$info}}</div>
</div>
