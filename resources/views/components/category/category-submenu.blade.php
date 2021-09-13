@props(['categories'])

<div class="CategoriesButton-submenu">
    @foreach($categories as $category)
        <a class="CategoriesButton-link" href="{{ route('catalog.category', $category->id) }}">
            <div class="CategoriesButton-icon">
                <img src="{{ asset('assets/img/icons/departments/'. $category->image_id . '.svg') }}" alt="{{$category->image_id}}"/>
            </div>
            <span class="CategoriesButton-text">{{$category->name}}</span>
            @if($category->children->isNotEmpty())
                <a class="CategoriesButton-arrow" href="{{$category->id}}"></a>
                <x-category.category-submenu :categories="$category->children"/>
            @endif
        </a>
    @endforeach
</div>
