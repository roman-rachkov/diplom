<div class="CategoriesButton">
    <div class="CategoriesButton-title">
        <div class="CategoriesButton-icon"><img src="{{ asset('assets/img/icons/allDep.svg') }}" alt="allDep.svg"/></div>
        <span class="CategoriesButton-text">Категории</span>
        <div class="CategoriesButton-arrow"></div>
    </div>
    <div class="CategoriesButton-content">
        @foreach($categories as $category)
            <x-category.category-item :category="$category" />
        @endforeach
    </div>
</div>
