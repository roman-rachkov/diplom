@props(['categories'])

<div class="CategoriesButton-submenu">
    @foreach($categories as $category)
        <a class="CategoriesButton-link" href="#">
            <div class="CategoriesButton-icon">
                <img src="assets/img/icons/departments/1.svg" alt="1.svg"/>
            </div>
            <span class="CategoriesButton-text">{{$category->name}}</span>
            @if($category->children->isNotEmpty())
                <a class="CategoriesButton-arrow" href="#"></a>
                <x-category.category-submenu :categories="$category->children"/>
            @endif
        </a>
    @endforeach
</div>
