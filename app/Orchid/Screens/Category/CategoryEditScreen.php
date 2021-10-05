<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CategoryEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = '';

    public function __construct()
    {
        $this->name = __('admin.category.edit_category');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): array
    {
        $this->exists = $category->exists;

        return [
            'category' => $category
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Save'))
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Save')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('category.name')
                    ->title(__('admin.category.title'))
                    ->placeholder(__('admin.category.name_placeholder')),

                Input::make('category.slug')
                    ->title(__('admin.category.slug'))
                    ->placeholder(__('admin.category.slug_placeholder')),

                Select::make('category.icon')
                    ->options([
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        5 => 5,
                        6 => 6,
                        7 => 7,
                        8 => 8,
                        9 => 9,
                        10 => 10,
                        11 => 11,
                        12 => 12,
                    ])
                    ->inlineAttributes(
                        [
                            'style' => 'display:none'
                        ]
                    )
                    ->title(__('admin.category.icon'))
                    ->help(__('admin.category.icon_help')),

                Relation::make('category.parent_id')
                    ->title(__('admin.category.parent'))
                    ->fromModel(Category::class, 'name'),

                CheckBox::make('category.is_active')
                    ->title(__('admin.category.is_active'))
                    ->sendTrueOrFalse(),

                Picture::make('category.image_id')
                    ->title(__('admin.category.image_id'))
                    ->targetId()
            ]),

        ];
    }

    /**
     * @param Category $category
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Category $category, Request $request)
    {
        $request->validate([
            'category.name' => 'required|min:3|max:100',
            'category.slug' => ['required', 'unique:categories,slug']
        ]);
        $requestArgs = $request->get('category');
        $requestArgs['sort_index'] = rand(1, 500);
        $category->fill($requestArgs)->save();
        Alert::info(__('admin.category.success_info'));
        return redirect()->route('platform.category.list');
    }

    /**
     * @param Category $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Category $category)
    {
        $category->delete();
        Alert::info(__('admin.category.delete_info'));
        return redirect()->route('platform.category.list');
    }
}
