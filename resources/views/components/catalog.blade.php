<div class="Cards">

    @foreach($productDiscountPriceDTO as $dto)
        <x-card :dto="$dto"/>
    @endforeach
</div>

{{ $paginationLink }}
