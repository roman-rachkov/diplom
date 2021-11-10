<header class="Section-header">
    <h2 class="Section-title">{{$title ?? __('components.top-products')}}</h2>
</header>

<div class="Cards">
    @foreach($productPricesWithDiscountsDTO as $dto)
        <x-card :dto="$dto"/>
    @endforeach
</div>
