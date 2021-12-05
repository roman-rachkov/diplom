<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\CharacteristicValue;
use App\Models\ComparedProduct;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\DiscountGroup;
use App\Models\Manufacturer;
use App\Models\Price;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Models\Attachmentable;


/**
 * run: sail artisan db:seed --class=Database\\Seeders\\DemoDataSeeders\\SkydescentSeeder
 */
class SkydescentSeeder extends Seeder
{
    public function run()
    {
        //Product::factory()->create(['limited_edition' => 1]);
        Attachment::factory()->create();

        $this->seedNestedSetCategories();
        $this->seedProduct();
    }

    protected function seedNestedSetCategories()
    {
        //Сидер, который создаёт вложенную структуру категорий
        $categories = [
            [
                'name' => 'Бытовая техника',
                'slug' => 'bytovaya_tekhnika',
                'icon_id' => Attachment::factory()
                    ->create($this->getAttachmentAttrsForImg('icons/oven.svg'))->id,
                'is_active' => 1,
                'sort_index' => 33,
                'image_id' => Attachment::factory()->create()->id,
                'children' =>
                    [
                        [
                            'name' => 'Стиральные машины',
                            'slug' => 'stiralnie_mashiny',
                            'icon_id' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForImg('icons/washer.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::factory()->create()->id,
                        ],
                        [
                            'name' => 'Миксеры',
                            'slug' => 'miksery',
                            'icon_id' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForImg('icons/mixer.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::factory()->create()->id,
                        ],
                        [
                            'name' => 'Чайники/Самовары',
                            'slug' => 'chainiki_samovary',
                            'icon_id' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForImg('icons/kettle.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::factory()->create()->id,
                        ],
                        [
                            'name' => 'Микроволновые печи',
                            'slug' => 'mikrovolnovki',
                            'icon_id' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForImg('icons/microwave.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::factory()->create()->id,
                            'children' =>
                                [
                                    [
                                        'name' => 'Микроволновые печи c дефектом',
                                        'slug' => 'mikrovolnovki_s_defektom',
                                        'icon_id' => Attachment::factory()
                                            ->create($this->getAttachmentAttrsForImg('icons/discount.svg'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                        'image_id' => Attachment::factory()->create()->id,
                                    ]
                                ]
                        ]
                    ]
            ],
            [
                'name' => 'Электроника',
                'slug' => 'elektronika',
                'icon_id' => Attachment::factory()
                    ->create($this->getAttachmentAttrsForImg('icons/tv.svg'))->id,
                'is_active' => 1,
                'sort_index' => 33,
                'image_id' => Attachment::factory()->create()->id,
                'children' =>
                    [
                        [
                            'name' => 'Телевизоры',
                            'slug' => 'televizory',
                            'icon_id' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForImg('icons/tv.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::factory()->create()->id,
                        ],
                        [
                            'name' => 'Фотоаппараты',
                            'slug' => 'photoapparati',
                            'icon_id' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForImg('icons/camera.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::factory()->create()->id,
                        ],
                        [
                            'name' => 'Смартфоны',
                            'slug' => 'mobilnie_telephony',
                            'icon_id' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForImg('icons/smartphone.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::factory()->create()->id,
                        ],
                        [
                            'name' => 'Аудиосистемы',
                            'slug' => 'audiosystemy',
                            'icon_id' => Attachment::factory()
                                ->create($this->getAttachmentAttrsForImg('icons/audio_system.svg'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::factory()->create()->id,
                            'children' =>
                                [
                                    [
                                        'name' => 'Домашние аудиосистемы',
                                        'slug' => 'domashniye_audiosystemy',
                                        'icon_id' => Attachment::factory()
                                            ->create($this->getAttachmentAttrsForImg('icons/audio_system.svg'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                        'image_id' => Attachment::factory()->create()->id,
                                        'children' =>
                                            [
                                                [
                                                    'name' => 'Аудиосистемы с дефектом',
                                                    'slug' => 'domashniye_audiosystemy_s_defectom',
                                                    'icon_id' => Attachment::factory()
                                                        ->create($this->getAttachmentAttrsForImg('icons/discount.svg'))->id,
                                                    'is_active' => 1,
                                                    'sort_index' => 33,
                                                    'image_id' => Attachment::factory()->create()->id,
                                                ]
                                            ]
                                    ],
                                    [
                                        'name' => 'Наушники',
                                        'slug' => 'naushniki',
                                        'icon_id' => Attachment::factory()
                                            ->create($this->getAttachmentAttrsForImg('icons/headset.svg'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                        'image_id' => Attachment::factory()->create()->id,
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
            'main_img_id' => Attachment::factory($this->getAttachmentAttrsForImg('seeder/skydescent/samovar_main.jpg')),
            'limited_edition' => 1,
            ])
            ->create();

        $this->seedAdditionalImgsForProduct($product);
        $this->seedSellersAndPricesForProduct($product);

        //Характеристики, значения характеристик
        $this->seedCharacteristics($product);

        //Пользователи, отзывы
        $this->seedReviews($product);

        //Скидка на продукт
        $this->seedDiscountForProduct($product);

    }

    protected function seedAdditionalImgsForProduct($product)
    {
        $attachments = array_map(function ($attachment) use ($product){
            return new Attachmentable(array_merge(
                $attachment,
                [
                    'attachmentable_type' => Attachment::class,
                    'attachmentable_id' => $product->id
                ]
            ));
            },
            [
                [
                    'attachment_id' => Attachment::factory()
                    ->create($this->getAttachmentAttrsForImg('seeder/skydescent/samovar_1.jpg'))
                    ->id
                ],
                [
                    'attachment_id' => Attachment::factory()
                        ->create($this->getAttachmentAttrsForImg('seeder/skydescent/samovar_2.jpg'))
                        ->id
                ],
                [
                    'attachment_id' => Attachment::factory()
                        ->create($this->getAttachmentAttrsForImg('seeder/skydescent/samovar_3.jpg'))
                        ->id
                ]
            ]
        );

        $product->additionalImages()->saveMany($attachments);
    }

    protected function seedCharacteristics(Product $product)
    {
        collect([
            ['name' => 'Вес', 'measure' => 'гр.', 'value' => 4900],
            ['name' => 'Материал', 'measure' => null, 'value' => 'латунь'],
            ['name' => 'Объём', 'measure' => 'мл.', 'value' => 5000],
            ['name' => 'цвет', 'measure' => null, 'value' => 'серебристый']

        ])->each(function ($item) use ($product) {

            $characteristic = Characteristic::factory()->create(['name' => $item['name'], 'measure' => $item['measure']]);
            $product->category->characteristics()
                ->save($characteristic);
            $product->characteristicValues()
                ->save(CharacteristicValue::factory()
                    ->create(['characteristic_id' => $characteristic->id, 'value' => $item['value']])
                );
        }
        );
    }

    protected function seedSellersAndPricesForProduct(Product $product)
    {
        //Продавцы, цены
        collect([
            ['name' => 'Самовар Град'],
            ['name' => 'Самовары.ру'],
            ['name' => 'Ваш самовар']
        ])->each(function ($seller) use ($product) {
            Price::factory()
                ->for(Seller::factory()
                    ->create($seller))
                ->for($product)->create(['price' => rand(200,300)]);
        });

    }

    protected function getAttachmentAttrsForImg(string $imgPath): array
    {
        [
            'dirname' => $imagePath,
            'basename' => $img,
            'extension' => $extension,
            'filename' => $name,
        ] = pathinfo($imgPath);

        $fullPath = storage_path('app/public/') . $imgPath;
        return [
            'name' => $name,
            'original_name' => $img,
            'mime' => mime_content_type($fullPath),
            'extension' => $extension,
            'size' => stat($fullPath)['size'],
            'path' => $imagePath . '/',
            'alt' => $img,
            'hash' => Hash::make($name),
            'user_id' => 1,
        ];
    }

    protected function seedReviews($product)
    {
        collect([
            ['review' => 'Превосходный самовар для всей семьи, очень рекомендую к покупке! Дров нужно совсем немного - порядка 5 кубов на один полный самовар!'],
            ['review' => 'Всегда покупаю патроны в Тульском заводе, и конечно не мог не заметить, что они ещё и самвоары делают. Отличная вещь, оружейная латунь, прослужит долго!'],
            ['review' => 'Советское качество, о чём тут можно ещё говорит, выдержит атомную войну!. Также его можно использовать и для приготовления крепиких напитков.'],
            ['review' => 'Такой же самовар достался мне от деда, как увидел такой в продаже - купил своему сыну, теперь ходим друг к другу по очереди чай пить!'],
            ['review' => 'Хорошая вещь! Из минусом - очень громоздкий и много дров уходит. Но эти минусы быстро забываются, когда сидишь у себя в доме и прьёшь горячий чаёк из него']
        ])->map(function ($review) use ($product) {
            return Review::factory()->create(array_merge($review, ['product_id' => $product->id]));
        });
    }

    protected function seedDiscountForProduct($product)
    {
        $product->discountGroups()->save(DiscountGroup::factory()
                ->for(Discount::factory()
                    ->create([
                        'title' => 'Скидка на самовары',
                        'value' => 30,
                        'method_type' => Discount::getMethodTypes()->random(),
                        'category_type' => Discount::CATEGORY_OTHER,
                        'weight' => 130,
                        'minimal_cost' => 200,
                        'maximum_cost' => 400,
                        'minimum_qty' => 2,
                        'maximum_qty' => 5,
                        'start_at' => Carbon::yesterday(),
                        'end_at' => Carbon::now()->addDays(20),
                        'is_active' => 1,
                        'description' => 'Скидка действут на самовары до дня всемирного чаепития'
                    ])
                )->create(['title' => 'скидки на самовары'])
            );
    }

    protected function seedComparedProducts()
    {
        //Добавляем user
        $customer = Customer::factory()
            ->for(User::factory()->create(['name' => 'Самоваров Аркадий Петрович']))
            ->create();

        [
            [
                'name' => 'Чайник электрический инновационный',
                'slug' => 'chainik_innovacionniy',
                'category_id' => Category::where('slug', 'chainiki_samovary')->get()->first()->id,
                'sort_index' => 7,
                'sales_count' => 70,
                'main_img_id' => Attachment::factory($this->getAttachmentAttrsForImg('seeder/skydescent/kettle.jpeg')),
            ],
            [
                'name' => 'Телевизионный приёмник "Горизонт"',
                'slug' => 'tv_horizont',
                'category_id' => Category::where('slug', 'televizory')->get()->first()->id,
                'sort_index' => 10,
                'sales_count' => 20,
                'main_img_id' => Attachment::factory($this->getAttachmentAttrsForImg('seeder/skydescent/horizont.jpg')),
            ],
            [
                'name' => 'Большой адронный коллайдер',
                'slug' => 'collider',
                'category_id' => Category::where('slug', 'mikrovolnovki')->get()->first()->id,
                'sort_index' => 10,
                'sales_count' => 20,
                'main_img_id' => Attachment::factory($this->getAttachmentAttrsForImg('seeder/skydescent/horizont.jpg')),
            ]
        ];

//        ComparedProduct::factory()
//            ->for($customer)
//            ->for()


    }
}
