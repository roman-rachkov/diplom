<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Models\Attachmentable;

/**
 * run: sail artisan db:seed --class=Database\\Seeders\\DemoDataSeeders\\TmoiseenkoSeeder
 */
class TmoiseenkoSeeder extends Seeder
{
    public function run()
    {
        $images = [
            'new_year' => [
                'product-1-2.jpg',
                'product-1-3.jpg',
                'product-1-4.jpg',
                'product-1-5.jpg',
            ],
            'valentines' => [
                'valentine-2.jpg',
                'valentine-3.jpg',
                'valentine-4.jpg',
            ],
        ];

        $prices = collect([
            5482.15,
            1658.12,
            4500.99,
            4659.00,
            8768.25,
            10548.55,
            3598.14,
        ]);

        $manuf = Attachment::factory($this->prepareAttachment('manufactureres.jpg'))->create();

        $sellersArr = [
            [
                'name' => 'Продавец №1',
                'description' => 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.',
                'email' => 'seller-1@sellers.ee',
                'phone' => '1234567890',
                'address' => '431568, г. Ишеевка, ул. Академика Несмеянова',
                'logo_id' => $manuf->id,
            ],
            [
                'name' => 'Продавец №2',
                'description' => 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.',
                'email' => 'seller-2@sellers.ee',
                'phone' => '1234567890',
                'address' => '659084, г. Вишневое, ул. Старонародная',
                'logo_id' => $manuf->id,
            ],
            [
                'name' => 'Продавец №3',
                'description' => 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.',
                'email' => 'seller-3@sellers.ee',
                'phone' => '1234567890',
                'address' => '369160, г. Подольск, ул. Хвойная, дом 25,',
                'logo_id' => $manuf->id,
            ],
        ];

        $sellersObj = [];

        $user = User::factory([
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
            'logo_id' => $manuf->id
        ])->create();

        $valentinesManufacturer = Manufacturer::factory([
            'name' => 'LoVe Factory',
            'email' => 'love@factory.ru',
            'address' => '555555, Россия.',
            'logo_id' => $manuf->id
        ])->create();

        $newYearCat = Category::factory([
            'name' => 'Новогодние подарки',
            'slug' => "new_year",
            'icon_id' => Attachment::factory($this->prepareAttachment('icons/pinetree.png')),
            'sort_index' => 0,
            'is_active' => true,
        ])->create();

        $valentinesYearCat =  Category::factory([
            'name' => 'Подарочные наборы',
            'slug' => "valentines_day",
            'icon_id' => Attachment::factory($this->prepareAttachment('icons/heart.png')),
            'sort_index' => 0,
            'is_active' => true,
        ])->create();

        $newProduct =  Product::factory([
            'name' => 'Новогодний набор',
            'description' => 'Набор от голландского бренда House of Seasons состоит из 26 стеклянных шаров разного диаметра ( O 5СМ - 8 шт; O 6СМ - 6 шт; O 7СМ - 12шт) в ярко- розовом цвете',
            'full_description' => 'Набор от голландского бренда House of Seasons состоит из 26 стеклянных шаров разного диаметра ( O 5СМ - 8 шт; O 6СМ - 6 шт; O 7СМ - 12шт) в ярко- розовом цвете, упакован в стильную подарочную коробку. Благодаря сочетанию матовых и глянцевых фактур шариков в данной коллекции, а также их яркому и насыщенному исполнению, Вы невероятно легко и с удовольствием создадите неповторимый дизайн для Вашей елочки!',
            'slug' => 'new_year_product',
            'sort_index' => 0,
            'sales_count' => 0,
            'limited_edition' => true,
            'manufacturer_id' => $newYearManufacturer->id,
            'main_img_id' => Attachment::factory($this->prepareAttachment('products/product-1-1.jpg')),
            'category_id' => $newYearCat->id,
        ])->create();

        $valentinesProduct =  Product::factory([
            'name' => 'Сладкий набор ко дню влюбленных',
            'description' => 'Набор от голландского бренда House of Seasons состоит из 26 стеклянных шаров разного диаметра ( O 5СМ - 8 шт; O 6СМ - 6 шт; O 7СМ - 12шт) в ярко- розовом цвете',
            'full_description' => 'Набор от голландского бренда House of Seasons состоит из 26 стеклянных шаров разного диаметра ( O 5СМ - 8 шт; O 6СМ - 6 шт; O 7СМ - 12шт) в ярко- розовом цвете, упакован в стильную подарочную коробку. Благодаря сочетанию матовых и глянцевых фактур шариков в данной коллекции, а также их яркому и насыщенному исполнению, Вы невероятно легко и с удовольствием создадите неповторимый дизайн для Вашей елочки!',
            'slug' => 'valentines_product',
            'sort_index' => 0,
            'sales_count' => 0,
            'limited_edition' => true,
            'manufacturer_id' => $valentinesManufacturer->id,
            'main_img_id' => Attachment::factory($this->prepareAttachment('products/valentine-1.jpg')),
            'category_id' => $valentinesYearCat->id,
        ])->create();

        foreach ($sellersArr as $seller) {
            $sellersObj[] = Seller::factory()->create($seller);
        }

        foreach ($images['new_year'] as $image) {
            $newProduct->additionalImages()->save(new Attachmentable([
                'attachmentable_type' => Attachment::class,
                'attachmentable_id' => $newProduct->id,
                'attachment_id' => Attachment::factory($this->prepareAttachment('products/' . $image))->create()->id,
            ]));
        }

        foreach ($images['valentines'] as $image) {
            $valentinesProduct->additionalImages()->save(new Attachmentable([
                'attachmentable_type' => Attachment::class,
                'attachmentable_id' => $valentinesProduct->id,
                'attachment_id' => Attachment::factory($this->prepareAttachment('products/' . $image))->create()->id,
            ]));
        }

        foreach ($sellersObj as $seller) {
            Price::factory()->create([
                'price' => $prices->random(),
                'product_id' => $newProduct->id,
                'seller_id' => $seller->id,
            ]);

            Price::factory()->create([
                'price' => $prices->random(),
                'product_id' => $valentinesProduct->id,
                'seller_id' => $seller->id,
            ]);
        }

        Banner::factory([
            'title' => 'Новогодиние скидки',
            'subtitle' => 'В нашем магазине действую новогодние скидки на все товары в размере 30%',
            'button_text' => 'Узнать больше',
            'href' => 'https://laraveldiplomagroup01.mvsvolkov.ru/products/new_year_product',
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
            'href' => 'https://laraveldiplomagroup01.mvsvolkov.ru/products/valentines_product',
            'is_active' => true,
            'image_id' => Attachment::factory($this->prepareAttachment('banners/banner-3.jpg')),
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
