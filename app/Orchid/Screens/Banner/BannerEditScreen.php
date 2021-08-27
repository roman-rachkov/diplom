<?php

namespace App\Orchid\Screens\Banner;

use App\Models\Banner;

use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class BannerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Banners';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Banner $banner): array
    {
        $this->exists = $banner->exists;

        if ($this->exists) {
            $this->name = 'Edit post';
        }

        $banner->load('attachment');

        return [
            'banner' => $banner
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
            Button::make('Create new')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
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
                TextArea::make('banner.title')
                    ->rows(3)
                    ->title('Title')
                    ->placeholder('Banner title'),

                TextArea::make('banner.subtitle')
                    ->title('Subtitle')
                    ->rows(3)
                    ->placeholder('Banner subtitle'),


                Input::make('banner.button_text')
                    ->title('Button text')
                    ->placeholder('Banner button text'),

                Input::make('banner.href')
                    ->title('Button URL')
                    ->placeholder('Link where the user will be redirected'),

                CheckBox::make('banner.is_active')
                    ->title('Activate banner')
                    ->placeholder('If the flag is set, the banner will be displayed')
                    ->sendTrueOrFalse(),

                Cropper::make('banner.image_id')
                    ->targetId()
                    ->title('Large web banner image, generally in the front and center')
                    ->width(735)
                    ->height(454),

            ])
        ];
    }

    /**
     * @param Banner $banner
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Banner $banner, Request $request)
    {
        $banner->fill($request->get('banner'))->save();

        $banner->attachment()->syncWithoutDetaching(
            $request->input('banner.attachment', [])
        );

        Alert::info('You have successfully created an banner.');

        return redirect()->route('platform.banner.list');
    }

    /**
     * @param Banner $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Banner $banner)
    {
        $banner->delete();

        Alert::info('You have successfully deleted the banner.');

        return redirect()->route('platform.banner.list');
    }
}
