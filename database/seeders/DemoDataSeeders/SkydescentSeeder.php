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
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Price;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\PaymentsServiceSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Models\Attachmentable;
use Orchid\Platform\Models\Role;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;


/**
 * run: sail artisan db:seed --class=Database\\Seeders\\DemoDataSeeders\\SkydescentSeeder
 */
class SkydescentSeeder extends Seeder
{
    public function run()
    {
        //$this->call([PaymentsServiceSeeder::class]);
        //$user = User::find(1);
        //$user = $this->seedUser();
        //Attachment::factory()->create();
        $this->seedNestedSetCategories();
        //$this->seedProduct();
        //$this->seedComparedProducts($user);
        //$this->seedCartWitDiscount($user);
    }

    protected function seedUser()
    {
       return  User::factory()
           ->has(Attachment::factory($this->prepareAttachment('users/samovarov.jpg',
                 date('Y/m/d') . '/')))
           ->has(Role::factory([
               'slug' => 'administrator',
               'name' => 'Администратор',
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
           ]))
             ->create(
                [
                    'name' => 'Самоваров Аркадий Петрович',
                    'email' => 'samovarov@email.com',
                    'email_verified_at' => now(),
                    'phone' => '99988877711'
                ]);
    }


    protected function seedNestedSetCategories()
    {
        //Сидер, который создаёт вложенную структуру категорий
        $categories = [
            [
                'name' => 'Бытовая техника',
                'slug' => 'bytovaya_tekhnika',
                'icon_id' => Attachment::factory()
                    ->create($this->prepareAttachment('categories/icons/oven.svg', 'icons/'))->id,
                'is_active' => 1,
                'sort_index' => 33,
                'image_id' => Attachment::first()->id,
                'children' =>
                    [
                        [
                            'name' => 'Стиральные машины',
                            'slug' => 'stiralnie_mashiny',
                            'icon_id' => Attachment::factory()
                                ->create($this->prepareAttachment('categories/icons/washer.svg', 'icons/'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::first()->id,
                        ],
                        [
                            'name' => 'Миксеры',
                            'slug' => 'miksery',
                            'icon_id' => Attachment::factory()
                                ->create($this->prepareAttachment('categories/icons/mixer.svg', 'icons/'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::first()->id,
                        ],
                        [
                            'name' => 'Чайники/Самовары',
                            'slug' => 'chainiki_samovary',
                            'icon_id' => Attachment::factory()
                                ->create($this->prepareAttachment('categories/icons/kettle.svg', 'icons/'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::first()->id,
                        ],
                        [
                            'name' => 'Микроволновые печи',
                            'slug' => 'mikrovolnovki',
                            'icon_id' => Attachment::factory()
                                ->create($this->prepareAttachment('categories/icons/microwave.svg', 'icons/'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::first()->id,
                            'children' =>
                                [
                                    [
                                        'name' => 'Микроволновые печи c дефектом',
                                        'slug' => 'mikrovolnovki_s_defektom',
                                        'icon_id' => Attachment::factory()
                                            ->create($this->prepareAttachment('categories/icons/discount.svg', 'icons/'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                        'image_id' => Attachment::first()->id,
                                    ]
                                ]
                        ]
                    ]
            ],
            [
                'name' => 'Электроника',
                'slug' => 'elektronika',
                'icon_id' => Attachment::factory()
                    ->create($this->prepareAttachment('categories/icons/tv.svg', 'icons/'))->id,
                'is_active' => 1,
                'sort_index' => 33,
                'image_id' => Attachment::first()->id,
                'children' =>
                    [
                        [
                            'name' => 'Телевизоры',
                            'slug' => 'televizory',
                            'icon_id' => Attachment::factory()
                                ->create($this->prepareAttachment('categories/icons/tv.svg', 'icons/'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::first()->id,
                        ],
                        [
                            'name' => 'Фотоаппараты',
                            'slug' => 'photoapparati',
                            'icon_id' => Attachment::factory()
                                ->create($this->prepareAttachment('categories/icons/camera.svg', 'icons/'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::first()->id,
                        ],
                        [
                            'name' => 'Смартфоны',
                            'slug' => 'mobilnie_telephony',
                            'icon_id' => Attachment::factory()
                                ->create($this->prepareAttachment('categories/icons/smartphone.svg', 'icons/'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::first()->id,
                        ],
                        [
                            'name' => 'Аудиосистемы',
                            'slug' => 'audiosystemy',
                            'icon_id' => Attachment::factory()
                                ->create($this->prepareAttachment('categories/icons/audio_system.svg', 'icons/'))->id,
                            'is_active' => 1,
                            'sort_index' => 33,
                            'image_id' => Attachment::first()->id,
                            'children' =>
                                [
                                    [
                                        'name' => 'Домашние аудиосистемы',
                                        'slug' => 'domashniye_audiosystemy',
                                        'icon_id' => Attachment::factory()
                                            ->create($this->prepareAttachment('categories/icons/audio_system.svg', 'icons/'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                        'image_id' => Attachment::first()->id,
                                        'children' =>
                                            [
                                                [
                                                    'name' => 'Аудиосистемы с дефектом',
                                                    'slug' => 'domashniye_audiosystemy_s_defectom',
                                                    'icon_id' => Attachment::factory()
                                                        ->create($this->prepareAttachment('categories/icons/discount.svg', 'icons/'))->id,
                                                    'is_active' => 1,
                                                    'sort_index' => 33,
                                                    'image_id' => Attachment::first()->id,
                                                ]
                                            ]
                                    ],
                                    [
                                        'name' => 'Наушники',
                                        'slug' => 'naushniki',
                                        'icon_id' => Attachment::factory()
                                            ->create($this->prepareAttachment('categories/icons/headset.svg', 'icons/'))->id,
                                        'is_active' => 1,
                                        'sort_index' => 33,
                                        'image_id' => Attachment::first()->id,
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
            'logo_id' => Attachment::first()->id
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
            'main_img_id' => Attachment::factory($this->prepareAttachment('products/images/samovar_main.jpg', date('Y/m/d') . '/')),
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
                    ->create($this->prepareAttachment('products/images/samovar_1.jpg', date('Y/m/d') . '/'))
                    ->id
                ],
                [
                    'attachment_id' => Attachment::factory()
                        ->create($this->prepareAttachment('products/images/samovar_2.jpg', date('Y/m/d') . '/'))
                        ->id
                ],
                [
                    'attachment_id' => Attachment::factory()
                        ->create($this->prepareAttachment('products/images/samovar_3.jpg', date('Y/m/d') . '/'))
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
            ['name' => 'цвет', 'measure' => null, 'value' => 'серебристый'],
            ['name' => 'Уникальность', 'measure' => null, 'value' => 'только на нашей площадке']

        ])->each(function ($item) use ($product) {

            $characteristic = Characteristic::factory()->create(['name' => $item['name'], 'measure' => $item['measure']]);
            $product->category->characteristics()
                ->save($characteristic);
            CharacteristicValue::factory()
                    ->create(['characteristic_id' => $characteristic->id, 'value' => $item['value'], 'product_id' => $product->id]);
        }
        );
    }

    protected function seedSellersAndPricesForProduct(Product $product)
    {
        //Продавцы, цены
        collect([
            ['name' => 'Самовар Град', 'logo_id' => Attachment::factory()
                ->create($this->prepareAttachment('sellers/images/samovar_paint.jpeg', date('Y/m/d') . '/'))],
            ['name' => 'Самовары.ру', 'logo_id' => Attachment::factory()
                ->create($this->prepareAttachment('sellers/images/samovar_rospis.jpeg', date('Y/m/d') . '/'))],
            ['name' => 'Ваш самовар', 'logo_id' => Attachment::factory()
                ->create($this->prepareAttachment('sellers/images/samovar_run.jpeg', date('Y/m/d') . '/'))]
        ])->each(function ($seller) use ($product) {
            Price::factory()
                ->for(Seller::factory()->create(array_merge($seller, ['logo_id' => Attachment::first()->id])))
                ->for($product)->create(['price' => rand(200,300)]);
        });

    }

    protected function prepareAttachment(string $pathToFile, string $pathToSave)
    {
        $basePath = resource_path('img/seeders/kalashnikov/' . $pathToFile);

        if (file_exists($basePath)) {

            $storagePath = Storage::disk('public')->putFile($pathToSave, new File($basePath));

            $file = new File(Storage::disk('public')->path($storagePath));
            return [
                'name' => explode('.', $file->getBasename())[0],
                'original_name' => $file->getBasename(),
                'mime' => $file->getMimeType(),
                'extension' => $file->getExtension(),
                'size' => $file->getSize(),
                'path' => $pathToSave,
                'alt' => $file->getBasename(),
                'hash' => $file->hashName(),
                'user_id' => 1,
            ];
        }
        throw new FileNotFoundException('File ' . $basePath . ' not found', 404);
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
                        'weight' => 12,
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

    protected function seedComparedProducts($user)
    {
        //Добавляем user
        $customer = Customer::factory()
            ->for($user)
            ->create();

        $customer
            ->user
            ->avatar()
            ->save(
                Attachment::factory()
                    ->create(
                        $this->prepareAttachment('users/samovarov.jpg',
                            date('Y/m/d') . '/')
                    ));

        collect([
            [
                'name' => 'Чайник электрический инновационный',
                'slug' => 'chainik_innovacionniy',
                'description' => 'Инновационные решения этого чайника захватывают',
                'category_id' => Category::where('slug', 'chainiki_samovary')->get()->first()->id,
                'main_img_id' => Attachment::factory($this->prepareAttachment('products/images/kettle.jpeg', date('Y/m/d') . '/')),
                'seller' => ['name' => 'Kettle Company', 'logo_id' => Attachment::factory()
                    ->create($this->prepareAttachment('sellers/images/kettle_company.jpeg', date('Y/m/d') . '/'))],
                'price' => 50,
                'discount' => 10,
                'characteristics' => collect([
                    ['name' => 'Вес', 'measure' => 'гр.', 'value' => 1200],
                    ['name' => 'Материал', 'measure' => null, 'value' => 'пластик'],
                    ['name' => 'Объём', 'measure' => 'мл.', 'value' => 1700],
                    ['name' => 'Цвет', 'measure' => null, 'value' => 'альбинос'],
                    ['name' => 'Уникальность', 'measure' => null, 'value' => 'только на нашей площадке']
                ])
            ],
            [
                'name' => 'Телевизионный приёмник "Горизонт"',
                'slug' => 'tv_horizont',
                'description' => 'Классика не стареет!',
                'category_id' => Category::where('slug', 'televizory')->get()->first()->id,
                'main_img_id' => Attachment::factory($this->prepareAttachment('products/images/horizont.jpg', date('Y/m/d') . '/')),
                'seller' => ['name' => 'Horizont', 'logo_id' => Attachment::factory()
                    ->create($this->prepareAttachment('sellers/images/horizont_company.png', date('Y/m/d') . '/'))],
                'price' => 100,
                'discount' => 15,
                'characteristics' => collect([
                    ['name' => 'Вес', 'measure' => 'гр.', 'value' => 10000],
                    ['name' => 'Материал', 'measure' => null, 'value' => 'пластик и дерево'],
                    ['name' => 'Цвет', 'measure' => null, 'value' => 'белая кость'],
                    ['name' => 'Тип управления', 'measure' => null, 'value' => 'кнопки на панели'],
                    ['name' => 'Тип экрана', 'measure' => null, 'value' => 'Электронно-лучевая трубка'],
                    ['name' => 'Уникальность', 'measure' => null, 'value' => 'только на нашей площадке']
                ])
            ],
            [
                'name' => 'Большой адронный коллайдер',
                'slug' => 'collider',
                'description' => 'В представлении не нуждается, с вероятностью 3% может создать антивещество',
                'category_id' => Category::where('slug', 'mikrovolnovki')->get()->first()->id,
                'main_img_id' => Attachment::factory($this->prepareAttachment('products/images/collider.jpg', date('Y/m/d') . '/')),
                'seller' => ['name' => 'CERN', 'logo_id' => Attachment::factory()
                    ->create($this->prepareAttachment('sellers/images/cern_logo.jpeg', date('Y/m/d') . '/'))],
                'price' => 100,
                'characteristics' => collect([
                    ['name' => 'Вес', 'measure' => 'гр.', 'value' => 'подсчёты ещё ведутся'],
                    ['name' => 'Протяженность', 'measure' => 'км', 'value' => 100],
                    ['name' => 'Диаметр', 'measure' => 'км', 'value' => 27],
                    ['name' => 'Скорость протонов', 'measure' => '% от скорости света', 'value' => 99,9999991],
                    ['name' => 'Уникальность', 'measure' => null, 'value' => 'только на нашей площадке']
                ])
            ]
        ])->each(function ($item) use ($customer) {
            $product = Product::factory()
                ->has(
                    Price::factory(['price' => $item['price']])
                        ->for(Seller::factory($item['seller'])))
                ->create(array_slice($item, 0,5));


            if(isset($item['discount'])) {
                $product->discountGroups()
                    ->save(DiscountGroup::factory()
                        ->for(Discount::factory()
                            ->create([
                                'value' => $item['discount'],
                                'category_type' => Discount::CATEGORY_OTHER,
                                'is_active' => 1,
                                'start_at' => Carbon::now(),
                                'end_at' => Carbon::now()->addDays(10),
                                'weight' => 10
                            ]))->create());
            }


            $characteristics = [];

            foreach ($item['characteristics'] as $characteristic) {



                $char = Characteristic::firstOrCreate(
                    ['name' => $characteristic['name']],
                    ['measure' => $characteristic['measure']]
                );


                CharacteristicValue::factory()
                    ->create([
                        'value' => $characteristic['value'],
                        'characteristic_id' => $char->id,
                        'product_id' => $product->id
                    ]);
                $characteristics[] = $char;
            }

            $unique = collect($characteristics)->pluck('id')
                ->merge($product->category->characteristics->pluck('id'))
                ->unique();

            $product->category->characteristics()->sync($unique->toArray());

            ComparedProduct::factory()
                ->for($product)
                ->for($customer)
                ->create();
        });

    }

    public function seedCartWitDiscount($user)
    {
        $onSetDiscount = Discount::factory()
            ->create([
            'title' => 'Самовар и коллайдер в пол цены',
            'value' => 50,
            'method_type' => Discount::METHOD_CLASSIC,
            'category_type' => Discount::CATEGORY_SET,
            'weight' => 100,
            'minimal_cost' => 1,
            'maximum_cost' => 5000,
            'minimum_qty' => 1,
            'maximum_qty' => 20,
            'start_at' => Carbon::yesterday(),
            'end_at' => Carbon::now()->addDays(20),
            'is_active' => 1,
            'description' => 'Скидка на самовары и коллайдеры'
        ]);

        $collider = Product::where('slug', 'collider')->first();
        $collider->discountGroups()->save(DiscountGroup::factory()->for($onSetDiscount)->create());

        $samovar = Product::where('slug', 'samovar_classic')->first();
        $samovar->discountGroups()->save(DiscountGroup::factory()->for($onSetDiscount)->create());

        $customer = Customer::where('user_id', $user->id)->first();

        foreach ([$collider, $samovar] as $product) {
            OrderItem::create([
                    'order_id' => null,
                    'price_id' => $product->prices->first()->id,
                    'quantity' => rand(1,3),
                    'customer_id' => $customer->id,
                ]);
        }
    }
}
