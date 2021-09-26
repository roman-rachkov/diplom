<header class="Section-header">
    <h2 class="Section-title">{{$title ?? __('components.top-products')}}</h2>
</header>

<div class="Cards">
    @foreach($products as $product)
        <x-cart :product="$product"></x-cart>
    @endforeach
</div>
