@props(['images', 'mainImage'])

<div class="ProductCard-picts">
    <a class="ProductCard-pict ProductCard-pict_ACTIVE" href={{$mainImage->url}}>
        <img src={{$mainImage->getRelativeUrlAttribute()}} alt={{$mainImage->alt}}/>
    </a>
    @foreach($images as $image)
        <a class="ProductCard-pict" href={{$image->url}}>
            <img src={{$image->getRelativeUrlAttribute()}} alt={{$image->alt}}/>
        </a>
    @endforeach
</div>
