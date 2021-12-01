@props(['productDiscountPriceDTOs', 'productsPaginator'])

<div class="Cards">

    @foreach($productDiscountPriceDTOs as $dto)
        <x-card :dto="$dto"/>
    @endforeach
</div>

{{ $productsPaginator->links('components.pagination') }}
