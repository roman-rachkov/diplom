<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Orchid\Attachment\Models\Attachment;


/**
 * run: sail artisan db:seed --class=Database\\Seeders\\DemoDataSeeders\\SkydescentSeeder
 */
class SkydescentSeeder extends Seeder
{
    public function run()
    {
        $this->seedNestedSetCategories();
    }

    protected function seedNestedSetCategories()
    {
        //Сидер, который создаёт вложенную структуру категорий
        $categories = [
            [
                'name' => 'Бытовая техника',
                'slug' => 'bytovaya_tekhnika',
                'icon' => Attachment::factory()
                    ->create($this->getAttachmentAttrsForIcon('oven.svg'))->id,
                'is_active' => 1,
                'sort_index' => 33,
                'children' =>
                    [
                        [
                            'name' => 'Стиральные машины',
                            'slug' => 'stiralnie_mashiny',
                            'icon' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForIcon('washer.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Миксеры',
                            'slug' => 'miksery',
                            'icon' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForIcon('mixer.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Чайники/Самовары',
                            'slug' => 'chainiki_samovary',
                            'icon' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForIcon('kettle.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Микроволновые печи',
                            'slug' => 'mikrovolnovki',
                            'icon' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForIcon('microwave.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'children' =>
                                [
                                    [
                                        'name' => 'Микроволновые печи c дефектом',
                                        'slug' => 'mikrovolnovki_s_defektom',
                                        'icon' => Attachment::factory()
                                            ->create($this->getAttachmentAttrsForIcon('discount.svg'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                    ]
                                ]
                        ]
                    ]
            ],
            [
                'name' => 'Электроника',
                'slug' => 'elektronika',
                'icon' => Attachment::factory()
                    ->create($this->getAttachmentAttrsForIcon('tv.svg'))->id,
                'is_active' => 1,
                'sort_index' => 33,
                'children' =>
                    [
                        [
                            'name' => 'Телевизоры',
                            'slug' => 'televizory',
                            'icon' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForIcon('tv.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Фотоаппараты',
                            'slug' => 'photoapparati',
                            'icon' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForIcon('camera.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Смартфоны',
                            'slug' => 'mobilnie_telephony',
                            'icon' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForIcon('smartphone.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Аудиосистемы',
                            'slug' => 'audiosystemy',
                            'icon' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForIcon('audio_system.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'children' =>
                                [
                                    [
                                        'name' => 'Домашние аудиосистемы',
                                        'slug' => 'domashniye_audiosystemy',
                                        'icon' => Attachment::factory()
                                            ->create($this->getAttachmentAttrsForIcon('audio_system.svg'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                        'children' =>
                                            [
                                                [
                                                    'name' => 'Аудиосистемы с дефектом',
                                                    'slug' => 'domashniye_audiosystemy_s_defectom',
                                                    'icon' => Attachment::factory()
                                                        ->create($this->getAttachmentAttrsForIcon('discount.svg'))->id,
                                                    'is_active' => 1,
                                                    'sort_index' => 33,
                                                ]
                                            ]
                                    ],
                                    [
                                        'name' => 'Наушники',
                                        'slug' => 'naushniki',
                                        'icon' => Attachment::factory()
                                            ->create($this->getAttachmentAttrsForIcon('headset.svg'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                    ],
                                ]
                        ],
                    ]
            ]
        ];
        foreach ($categories as $node) {
            Category::create($node);
        }
    }

    protected function seedProduct()
    {
        $manufacturer = Manufacturer::factory([
            'name' => 'АО «Тульский патронный завод»',
            'email' => 'tpz@tulammo.ru',
            'address' => 'Россия, 300004, Тула, ул. Марата, 47-б',
            'logo_id' => Attachment::factory()
        ])
            ->create();

        $product = Product::factory([
            'name' => 'Самовар на дровах классический',
            'description' => 'Классический самовар жаровой «Дачный»',
            'full_description' => 'Формы самовара «банкой» и большой объем придают изделию солидный и даже торжественный вид. Хотя громоздким самовар не выглядит, благодаря округлости линий и светлому цвету. Несмотря на то, что изделию более полувека, он абсолютно готов к использованию и угостит вас ароматным чайком на даче. Вода в нем нагревается при помощи дров или угля. Это особенно приятный способ, который сделает чай удивительно вкусным. ',
            'slug' => 'samovar_classic',
            'category_id' => Category::where('slug', 'chainiki_samovary')->get()->first()->id,
            'sort_index' => 10,
            'sales_count' => 200,
            'manufacturer_id' => $manufacturer->id,
            'main_img_id' => Attachment::factory(),
            'limited_edition' => 1,
            ])
            ->create();



        //Характеристики, значения характеристик

        //Пользователи, отзывы
    }

    public function seedSellersAndPricesForProduct(Product $product)
    {
        //Продавцы, цены
        collect([
            ['name' => 'Самовар Град'],
            ['name' => 'Самовары.ру'],
            ['name' => 'Ваш самовар']
        ])->each(function ($seller){
            //Seller::factory()
            });
    }

    protected function getAttachmentAttrsForIcon(string $img): array
    {
        $iconsPath = 'icons/';
        $fullPath = storage_path('app/public/') . $iconsPath . $img;
        list($name, $extension) = explode('.', $img);
        return [
            'name' => $name,
            'original_name' => $img,
            'mime' => mime_content_type($fullPath),
            'extension' => $extension,
            'size' => stat($fullPath)['size'],
            'path' => $iconsPath,
            'alt' => $img,
            'hash' => Hash::make($name),
            'user_id' => 1,
        ];
    }
}
