@props(['request'])

<div class="Sort">
    <div class="Sort-title">{{ __('catalog.sort.sort_by') }}:
    </div>
    <div class="Sort-variants">
        <a class="Sort-sortBy {{ $request->getOrderBy() == 'price' ?  $request->getOrderDirection() == 'asc' ? 'Sort-sortBy_inc' : 'Sort-sortBy_dec' : '' }}"
           href="{{ url()->full() . $request->getQueryString() ? '?' : '&' }}order_by=price&order_direction={{ $request->getOrderDirection() == 'asc' ? 'desc' : 'asc' }}">
            {{ __('catalog.sort.price') }}
        </a>
        <a class="Sort-sortBy {{ $request->getOrderBy() == 'created_at' ? $request->getOrderDirection() == 'asc' ? 'Sort-sortBy_inc' : 'Sort-sortBy_dec' : '' }}"
           href="{{ url()->full() . $request->getQueryString() ? '?' : '&' }}order_by=created_at&order_direction={{ $request->getOrderDirection() == 'asc' ? 'desc' : 'asc' }}">{{ __('catalog.sort.date') }}</a>

        @if($request->getQueryString())
            <a class="Sort-sortBy" href="{{ url()->current() }}">{{ __('catalog.filter.clear') }}</a>
        @endif
    </div>
</div>
