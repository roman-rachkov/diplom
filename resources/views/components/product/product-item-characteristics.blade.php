<div class="Tabs-block" id="addit">
    <div class="Product-props">
        @foreach($characteristics as $characteristic)
            <div class="Product-prop">
                <strong>{{$characteristic['name']}}</strong>
                <span> {{$characteristic['value'] . ' ' . $characteristic['measure']}}</span>
            </div>
        @endforeach
    </div>
</div>
