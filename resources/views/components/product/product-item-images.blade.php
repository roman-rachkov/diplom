@props(['images', 'mainImage'])

<div class="ProductCard-picts">
    <a class="ProductCard-pict ProductCard-pict_ACTIVE" href={{$mainImage->url}}>
        <img src={{$mainImage->url}} alt={{$mainImage->alt}}/>
    </a>
    @foreach($images as $image)
        <a class="ProductCard-pict ProductCard-pict_ACTIVE" href={{$image->url}}>
            <img src={{$image->url}} alt={{$image->alt}}/>
        </a>
    @endforeach
</div>
