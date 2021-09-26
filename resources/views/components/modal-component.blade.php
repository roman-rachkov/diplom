@props(['id', 'slot'])
<div class="modal" id="{{$id}}">
    <div class="backplate">
        <div class="wrapper">
            <span class="modal-close"><i class="fa fa-close"></i></span>
            {{$slot}}
        </div>
    </div>
</div>
