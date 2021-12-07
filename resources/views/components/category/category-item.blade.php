@props(['category'])

<div class="CategoriesButton-link">
    <a href="{{ route('catalog.category', ['slug' => $category->slug]) }}">
        <div class="CategoriesButton-icon">
            <img src="{{ $category->icon->getRelativeUrlAttribute() }}" alt="{{$category->icon->alt}}"/>
        </div>
        <span class="CategoriesButton-text">{{$category->name}}</span>
    </a>
        @if($category->children->isNotEmpty())
                <a class="CategoriesButton-arrow" href="{{ route('catalog.category', ['slug' => $category->slug]) }}"></a>
                <x-category.category-submenu :categories="$category->children"/>
        @endif
</div>
