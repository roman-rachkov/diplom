@props(['images'])

<div class="ProductCard-picts">
    @foreach($images as $image)
        <a class="ProductCard-pict ProductCard-pict_ACTIVE" href={{$image->path}}>
            <img src={{$image->path}} alt={{$image->alt}}/>
        </a>
    @endforeach
</div>