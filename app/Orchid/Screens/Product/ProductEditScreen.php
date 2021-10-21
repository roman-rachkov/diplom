<?php

namespace App\Orchid\Screens\Product;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.products.edit_title');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Product $product): array
    {
        $this->exists = $product->exists;

        return [
            'product' => $product
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

    public function asyncAddPriceField($a)
    {
        return [
            'a' => $a,
            'AddPriceField' => $a,
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
            Layout::columns([
                Layout::rows([
                    Input::make('product.name')
                        ->title(__('admin.products.name'))
                        ->placeholder(__('admin.products.name_placeholder')),

                    Input::make('product.slug')
                        ->title(__('admin.products.slug'))
                        ->placeholder(__('admin.products.slug_placeholder')),


                    Relation::make('product.manufacturer')
                        ->title(__('admin.products.manufacturer'))
                        ->fromModel(Manufacturer::class, 'name'),

                    CheckBox::make('product.limited_edition')
                        ->title(__('admin.products.limited_edition'))
                        ->sendTrueOrFalse(),

                    Relation::make('product.sellers')
                        ->title(__('admin.products.sellers'))
                        ->fromModel(Seller::class, 'name')
                        ->multiple(),

                ]),
                Layout::rows([
                    Picture::make('category.image_id')
                        ->title(__('admin.products.main_img_id'))
                        ->targetId(),
                ]),
            ]),
        ];
    }

    /**
     * @param Product $product
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Product $product, Request $request)
    {
        $request->validate([
            'product.name' => 'required|min:3|max:100',
            'product.slug' => ['required', 'unique:categories,slug']
        ]);
        $requestArgs = $request->get('product');
        $requestArgs['sort_index'] = rand(1, 500);
        $product->fill($requestArgs)->save();
        Alert::info(__('admin.category.success_info'));
        return redirect()->route('platform.category.list');
    }

    /**
     * @param Product $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Product $product)
    {
        $product->delete();
        Alert::info(__('admin.category.delete_info'));
        return redirect()->route('platform.category.list');
    }
}
