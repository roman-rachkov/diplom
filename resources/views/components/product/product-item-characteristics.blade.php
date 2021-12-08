<div class="Tabs-block" id="addit">
    <div class="Product-props">
        @foreach($characteristics as $characteristic)
            <div class="Product-prop">
                <strong>{{$characteristic['name']}}</strong>
                @if(!is_null($characteristic['value']))
                    <span> {{$characteristic['value']}}</span>
                @endif
            </div>
        @endforeach
    </div>
</div>
