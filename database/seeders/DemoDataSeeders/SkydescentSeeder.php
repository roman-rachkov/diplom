<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;
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
        Attachment::factory()->create();
        $categories = [
            [
                'name' => 'Бытовая техника',
                'slug' => 'bytovaya_tekhnika',
                'icon' => 7,
                'is_active' => 1,
                'sort_index' => 33,
                'children' =>
                    [
                        [
                            'name' => 'Стиральные машины',
                            'slug' => 'stiralnie_mashiny',
                            'icon' => 3,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Миксеры',
                            'slug' => 'miksery',
                            'icon' => 12,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Чайники/Самовары',
                            'slug' => 'chainiki_samovary',
                            'icon' => 10,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Микроволновые печи',
                            'slug' => 'mikrovolnovki',
                            'icon' => 9,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'children' =>
                                [
                                    [
                                        'name' => 'Микроволновые печи c дефектом',
                                        'slug' => 'mikrovolnovki_s_defektom',
                                        'icon' => 4,
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
                'icon' => 1,
                'is_active' => 1,
                'sort_index' => 33,
                'children' =>
                    [
                        [
                            'name' => 'Телевизоры',
                            'slug' => 'televizory',
                            'icon' => 1,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Фотоаппараты',
                            'slug' => 'photoapparati',
                            'icon' => 6,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Смартфоны',
                            'slug' => 'mobilnie_telephony',
                            'icon' => 8,
                            'is_active' => 1,
                            'sort_index' => 33,
                        ],
                        [
                            'name' => 'Аудиосистемы',
                            'slug' => 'audiosystemy',
                            'icon' => 5,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'children' =>
                                [
                                    [
                                        'name' => 'Домашние аудиосистемы',
                                        'slug' => 'domashniye_audiosystemy',
                                        'icon' => 5,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                        'children' =>
                                            [
                                                [
                                                    'name' => 'Аудиосистемы с дефектом',
                                                    'slug' => 'domashniye_audiosystemy_s_defectom',
                                                    'icon' => 4,
                                                    'is_active' => 1,
                                                    'sort_index' => 33,
                                                ]
                                            ]
                                    ],
                                    [
                                        'name' => 'Наушники',
                                        'slug' => 'naushniki',
                                        'icon' => 2,
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
           // Seller::factory()
            });
    }
}
