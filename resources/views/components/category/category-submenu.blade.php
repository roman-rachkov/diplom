@props(['categories'])

<div class="CategoriesButton-submenu">
    @foreach($categories as $category)
        <a class="CategoriesButton-link" href="{{ route('catalog.category', ['slug' => $category->slug]) }}">
            <div class="CategoriesButton-icon">
                <img src="{{ $category->icon->getRelativeUrlAttribute() }}" alt="{{$category->icon->alt}}"/>
            </div>
            <span class="CategoriesButton-text">{{$category->name}}</span>
            @if($category->children->isNotEmpty())
                <a class="CategoriesButton-arrow" href="{{ route('catalog.category', ['slug' => $category->slug]) }}"></a>
                <x-category.category-submenu :categories="$category->children"/>
            @endif
        </a>
    @endforeach
</div>
