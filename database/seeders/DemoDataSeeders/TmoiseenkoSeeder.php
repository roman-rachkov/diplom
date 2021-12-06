<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Orchid\Attachment\Models\Attachment;

/**
 * run: sail artisan db:seed --class=Database\\Seeders\\DemoDataSeeders\\TmoiseenkoSeeder
 */
class TmoiseenkoSeeder extends Seeder
{
    public function run()
    {
        User::factory([
            'name' => 'tmoiseenko',
            'email' => 'tmoiseenko@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone' => '8974554533',
            'permissions' => [
                'platform.index' => 1,
                'platform.systems.roles' => 1,
                'platform.systems.users' => 1,
                'platform.systems.attachment' => 1,
                'platform.systems.settings' => 1,
                'platform.systems.import' => 1,
                'platform.elements.banners' => 1,
                'platform.elements.category' => 1,
                'platform.elements.products' => 1,
                'platform.elements.sellers' => 1,
                'platform.elements.discounts' => 1,
                'platform.elements.orders' => 1,

            ],
        ])->create();

        $newYearManufacturer = Manufacturer::factory([
            'name' => 'Фабрика новогодних подарков',
            'email' => 'ded@moroz.ru',
            'address' => '162390, Россия, Вологодская область, город Великий Устюг, дом Деда Мороза.',
            'logo_id' => Attachment::factory($this->prepareAttachment('manufactureres.jpg'))
        ])->create();

        $valentinesManufacturer = Manufacturer::factory([
            'name' => 'LoVe Factory',
            'email' => 'love@factory.ru',
            'address' => '555555, Россия.',
            'logo_id' => Attachment::factory($this->prepareAttachment('manufactureres.jpg'))
        ])->create();

        $newYearCat = Category::factory([
            'name' => 'Новогодние подарки',
            'slug' => "new_year",
            'icon_id' => Attachment::factory($this->prepareAttachment('icons/pinetree.png')),
            'sort_index' => 0,
            'is_active' => true,
        ])->create();


        $valentinesYearCat =  Category::factory([
            'name' => 'Подарочние наборы',
            'slug' => "valentines_day",
            'icon_id' => Attachment::factory($this->prepareAttachment('icons/heart.png')),
            'sort_index' => 0,
            'is_active' => true,
        ])->create();

        Banner::factory([
            'title' => 'Новогодиние скидки',
            'subtitle' => 'В нашем магазине действую новогодние скидки на все товары в размере 30%',
            'button_text' => 'Узнать больше',
            'href' => 'https://laraveldiplomagroup01.mvsvolkov.ru/discounts',
            'is_active' => true,
            'image_id' => Attachment::factory($this->prepareAttachment('banners/banner-1.jpg')),
        ])->create();

        Banner::factory([
            'title' => 'Скидки к 8 марта',
            'subtitle' => 'Не пропустите наши скидки в честь 8го марта, скидки начнут действовать с 25 февраля',
            'button_text' => 'Узнать больше',
            'href' => 'https://laraveldiplomagroup01.mvsvolkov.ru/discounts',
            'is_active' => false,
            'image_id' => Attachment::factory($this->prepareAttachment('banners/banner-3.jpg')),
        ])->create();

        Banner::factory([
            'title' => 'Специальное предложение ко Дню Святого Валентина',
            'subtitle' => 'Уникальное предложение купить подарочный набор своей любимой уже сейчас, по специальной цене.',
            'button_text' => 'Узнать больше',
            'href' => 'https://laraveldiplomagroup01.mvsvolkov.ru/discounts',
            'is_active' => true,
            'image_id' => Attachment::factory($this->prepareAttachment('banners/banner-1.jpg')),
        ])->create();

    }

    protected function prepareAttachment(string $pathToFile)
    {
        $datePath = \Illuminate\Support\Carbon::now()->format('Y/m/d/');
        $basePath = resource_path('img/seeders/tmoiseenko/' . $pathToFile);

        if (file_exists($basePath)) {

            $storagePath = Storage::disk('public')->putFile($datePath, new File($basePath));

            $file = new File(Storage::disk('public')->path($storagePath));
            return [
                'name' => explode('.', $file->getBasename())[0],
                'original_name' => $file->getBasename(),
                'mime' => $file->getMimeType(),
                'extension' => $file->getExtension(),
                'size' => $file->getSize(),
                'path' => $datePath,
                'alt' => $file->getBasename(),
                'hash' => $file->hashName(),
                'user_id' => 1,
            ];
        }
        throw new FileNotFoundException('File ' . $basePath . ' not found', 404);
    }

}
