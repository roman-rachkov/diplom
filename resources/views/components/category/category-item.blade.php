<div class="CategoriesButton-link"><a href="#">
        <div class="CategoriesButton-icon"><img src="assets/img/icons/departments/1.svg" alt="1.svg"/>
        </div><span class="CategoriesButton-text">{{$category->name}}</span></a>
        @if(!$category->isLeaf())
                <a class="CategoriesButton-arrow" href="#"></a>
                <x-category.category-submenu :categories="$category->children"/>
        @endif
</div>