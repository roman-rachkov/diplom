<?php

namespace App\Orchid\Screens;

use App\Contracts\Repository\SellerRepositoryContract;
use App\Models\Seller;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class SellerEditScreen extends Screen
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
    public function query(Seller $seller): array
    {
        $this->exists = $seller->exists;

        return [
            'seller' => $seller
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
                Input::make('seller.name')
                    ->title(__('admin.sellers.title'))
                    ->placeholder(__('admin.sellers.name_placeholder')),

                Input::make('seller.email')
                    ->title(__('Email'))
                    ->placeholder(__('admin.sellers.name_placeholder')),

                Input::make('seller.phone')
                    ->title(__('admin.sellers.phone_number'))
                    ->placeholder(__('admin.sellers.name_placeholder')),

                TextArea::make('seller.description')
                    ->title(__('admin.sellers.description'))
                    ->placeholder(__('admin.sellers.description_placeholder')),

                Input::make('seller.address')
                    ->title(__('admin.sellers.address'))
                    ->placeholder(__('admin.sellers.address_placeholder')),

                Picture::make('seller.logo_id')
                    ->title(__('admin.sellers.logo_id'))
                    ->targetId()
            ]),


        ];
    }

    /**
     * @param Seller $seller
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Seller $seller, Request $request)
    {
        //TODO: fix method
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

        //TODO: fix method
        $category->delete();
        Alert::info(__('admin.category.delete_info'));
        return redirect()->route('platform.category.list');
    }
}
