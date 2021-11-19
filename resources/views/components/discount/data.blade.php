@props(['discount'])

@if($discount->start_at)
    <div class="Card-date">
        <strong class="Card-date-number">{{ $discount->start_at->format('d') }}
        </strong><span class="Card-date-month">{{ $discount->start_at->format('M') }}</span>
    </div>
@endif
@if($discount->end_at)
    <div class="Card-date Card-date_to">
        <strong class="Card-date-number">{{ $discount->end_at->format('d') }}
        </strong><span class="Card-date-month">{{ $discount->end_at->format('M') }}</span>
    </div>
@endif
