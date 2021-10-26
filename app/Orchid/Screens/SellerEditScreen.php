<?php

namespace App\Orchid\Screens;

use App\Models\Seller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
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
     * @return Action[]
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
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('seller.name')
                    ->title(__('admin.sellers.title'))
                    ->placeholder(__('admin.sellers.name_placeholder')),

                Input::make('seller.email')
                    ->type('email')
                    ->title(__('Email'))
                    ->placeholder(__('admin.sellers.name_placeholder')),

                Input::make('seller.phone')
                    ->type('number')
                    ->title(__('admin.sellers.phone_number'))
                    ->placeholder(__('admin.sellers.name_placeholder')),

                TextArea::make('seller.description')
                    ->rows(5)
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
     * @return RedirectResponse
     */
    public function createOrUpdate(Seller $seller, Request $request): RedirectResponse
    {
        $request->validate([
            'seller.name' => 'required|min:10|max:100',
            'seller.email' => ['required', 'unique:sellers,email'],
            'seller.phone' => 'required|numeric',
            'seller.description' => 'required|min:50|max:1000',
            'seller.address' => 'required|min:20|max:100'
        ]);

        $attrs = $request->get('seller');
        $attrs['logo_id'] = $attrs['logo_id'] ?? '1';

        $seller->fill($attrs)->save();
        Alert::info(__('admin.sellers.success_info'));
        return redirect()->route('platform.sellers');
    }

    /**
     * @param Seller $seller
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(Seller $seller): RedirectResponse
    {
        $seller->delete();
        Alert::info(__('admin.category.delete_info'));
        return redirect()->route('platform.sellers');
    }
}
