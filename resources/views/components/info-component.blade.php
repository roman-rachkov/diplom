@props(['title', 'info', 'classes'=> null, 'id'=>null])
<div class="Order-info {{$classes ?? ''}}" {{$id?'id="'.$id.'"' : ''}}>
    <div class="Order-infoType">{{$title}}:</div>
    <div class="Order-infoContent">{{$slot}}</div>
</div>
