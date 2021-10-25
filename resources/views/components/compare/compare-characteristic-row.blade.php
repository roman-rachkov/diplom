@props(['characteristic'])

<div class="Compare-row{{$characteristic->isValuesEqual ? ' Compare-row_hide' : ''}}">
    <div class="Compare-title">
        {{$characteristic->name}}
    </div>
    <div class="Compare-products">
        @foreach($characteristic->values as $value)
            <div class="Compare-product">
                <div class="Compare-feature">{{$value . ' ' . $characteristic->measure}}
                </div>
            </div>
        @endforeach
    </div>
</div>
