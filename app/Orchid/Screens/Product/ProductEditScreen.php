<?php

namespace App\Orchid\Screens\Product;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Price;
use App\Models\Product;
use App\Orchid\Layouts\Product\SellerPriceTableLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

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
        $product->load('attachment');
        return [
            'product' => $product,
            'sellers' => $product->sellers,
            'prices' => $product->prices,
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
            ModalToggle::make(__('admin.products.add_new_price_modal_button'))
                ->modal('addNewPriceAndSeller')
                ->method('addNewPriceAndSeller')
                ->icon('money')
                ->modalTitle(__('admin.products.add_new_price_modal_title'))
                ->canSee($this->exists),

            Button::make('Save')
                ->icon('note')
                ->method('update')
                ->canSee($this->exists),

            Button::make('Save')
                ->icon('note')
                ->method('update')
                ->canSee(!$this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * @param Price $price
     * @return Price[]
     */
    public function asyncGetPriceAndSeller(Price $price)
    {
        return ['price' => $price];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::tabs([
                __('admin.products.main_tab') => [
                    Layout::rows([
                        Input::make('product.name')
                            ->title(__('admin.products.name'))
                            ->placeholder(__('admin.products.name_placeholder')),

                        Input::make('product.slug')
                            ->title(__('admin.products.slug'))
                            ->placeholder(__('admin.products.slug_placeholder')),

                        Relation::make('product.category_id')
                            ->title(__('admin.products.category'))
                            ->fromModel(Category::class, 'name'),

                        Relation::make('product.manufacturer')
                            ->title(__('admin.products.manufacturer'))
                            ->fromModel(Manufacturer::class, 'name'),

                        CheckBox::make('product.limited_edition')
                            ->title(__('admin.products.limited_edition'))
                            ->sendTrueOrFalse(),

                        Quill::make('product.description')
                            ->title(__('admin.products.description')),

                        Quill::make('product.full_description')
                            ->title(__('admin.products.full_description'))
                    ]),
                ],
                __('admin.products.images_tab') => [
                    Layout::rows([
                        Picture::make('product.main_img_id')
                            ->title(__('admin.products.main_img_id'))
                            ->targetId(),
                        Upload::make('product.attachment')
                            ->title(__('admin.products.additional_img'))
                    ]),
                ],
                __('admin.products.seller_prices_tab') => [
                    SellerPriceTableLayout::class
                ],
            ]),

            Layout::modal('editPriceAndSeller', Layout::rows([
                Input::make('price.id')
                    ->type('hidden'),
                Input::make('price.seller.name')
                    ->disabled()
                    ->title(__('admin.products.seller')),
                Input::make('price.price')
                    ->required()
                    ->title(__('admin.products.price')),
            ]))->title(__('admin_config.editing'))
                ->applyButton(__('Save'))
                ->async('asyncGetPriceAndSeller')
                ->withoutCloseButton(),

            Layout::modal('addNewPriceAndSeller', Layout::rows([
                Input::make('product.id')->type('hidden'),
                Relation::make('seller')
                    ->title(__('admin.products.seller'))
                    ->required()
                    ->fromModel(Manufacturer::class, 'name'),
                Input::make('price')
                    ->required()
                    ->title(__('admin.products.price')),
            ]))->title(__('admin_config.editing'))
                ->applyButton(__('Save'))
                ->async('asyncAddNewPriceAndSeller')
                ->withoutCloseButton(),
        ];
    }

    /**
     * @param Product $product
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, Request $request)
    {
        $product->fill($request->post('product'))->save();

        $product->attachment()->syncWithoutDetaching(
            $request->input('product.attachment', [])
        );

        Alert::info(__('admin.product.success_info'));
        return redirect()->route('platform.products');
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
        return redirect()->route('platform.products');
    }

    public function updatePriceAndSeller(Request $request)
    {
        $price = Price::where(['id' => $request->price['id']])->update(['price' => $request->price['price']]);
        Toast::info(__('admin.product.price_updated'));
    }

    public function addNewPriceAndSeller(Request $request)
    {
        Price::create([
           'product_id' => $request->input('product')['id'],
           'price' => $request->input('price'),
           'seller_id' => $request->input('seller'),
        ]);
        Toast::info(__('admin.product.price_created'));
    }
}
