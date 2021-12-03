<div class="Account-group">
    <div class="Account-column Account-column_full">
        <header class="Section-header">
            <h2 class="Section-title">{{__('view_history.history')}}
            </h2>
        </header>
        <div class="Cards Cards_account">
            @foreach($viewedProductsDTOs as $dto)
                <x-card :dto="$dto" />
            @endforeach
        </div>
        <div class="Account-editLink Account-editLink_view">
            <a href="{{route('users.viewed_products', $user)}}">
                {{__('view_history.go_to_full_list')}}
            </a>
        </div>
    </div>
</div>
