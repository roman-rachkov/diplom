@props(['category'])

<div class="CategoriesButton-link"><a href="#">
        <div class="CategoriesButton-icon"><img src={{$category->image->path}} alt={{$category->image->alt}}/>
        </div><span class="CategoriesButton-text">{{$category->name}}</span></a>
        @if($category->children->isNotEmpty())
                <a class="CategoriesButton-arrow" href="#"></a>
                <x-category.category-submenu :categories="$category->children"/>
        @endif
</div>
