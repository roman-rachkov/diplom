<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Database\Seeders\DiscountSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Models\Attachmentable;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * run: sail artisan db:seed --class=Database\\Seeders\\DemoDataSeeders\\Pakycb84Seeder
 */
class Pakycb84Seeder extends Seeder
{
    public function run()
    {
        $array = [
            'bytovaya_tekhnika' => [
                'name' => 'Бытовая техника',
                'stiralnie_mashiny' => [
                    'name' => 'Стиральные машины',
                ],
                'chainiki_samovary' => [
                    'name' => 'Чайники/Самовары',
                    'products' => [
                        [
                            'name' => 'Самовар на дровах классический',
                            'description' => 'Классический самовар жаровой «Дачный»',
                            'slug' => 'samovar_classic',
                        ],
                        [
                            'name' => 'Чайник электрический',
                            'description' => 'Обычный китайский чайник',
                            'slug' => 'obichniy_chainik',
                        ]
                    ]
                ],
                'mikrovolnovki' => [
                    'name' => 'Микроволновые печи',
                    'mikrovolnovki_s_defektom' => [
                        'name' => 'Микроволновые печи c дефектом'
                    ],
                    'products' => [
                        [
                            'name' => 'Микроволновка',
                            'description' => 'Классическая микроволновка с простым управлением',
                            'slug' => 'classic_microvawe',
                        ],
                        [
                            'name' => 'Ретро-микроволновка',
                            'description' => 'Ретром икроволновка с паровым управлением',
                            'slug' => 'retro_microvawe',
                        ]
                    ]
                ],
                'miksery' => [
                    'name' => 'Миксеры'
                ],
            ],
            'elektronika' => [
                'name' => 'Электроника',
                'audiosystemy' => [
                    'name' => 'Аудиосистемы',
                    'domashniye_audiosystemy' => [
                        'name' => 'Домашние аудиосистемы',
                        'domashniye_audiosystemy_s_defectom' => [
                            'name' => 'Аудиосистемы с дефектом',
                        ]
                    ],
                    'naushniki' => [
                        'name' => 'Наушники',
                        'products' => [
                            [
                                'name' => 'Exployd',
                                'description' => 'Наушники Exployd',
                                'slug' => 'exployd',
                            ],[
                                'name' => 'HyperX',
                                'description' => 'Наушники HyperX',
                                'slug' => 'hyperx',
                            ],[
                                'name' => 'JBL',
                                'description' => 'Наушники JBL',
                                'slug' => 'jbl',
                            ],[
                                'name' => 'Sony',
                                'description' => 'Наушники Sony',
                                'slug' => 'sony',
                            ],
                        ]
                    ]
                ],
                'mobilnie_telephony' => [
                    'name' => 'Смартфоны',
                    'products' => [
                        [
                            'name' => 'BQ',
                            'description' => 'Смартон BQ',
                            'slug' => 'bq',
                        ],[
                            'name' => 'DEXP',
                            'description' => 'Смартон DEXP',
                            'slug' => 'dexp',
                        ],[
                            'name' => 'INOI',
                            'description' => 'Смартон INOI',
                            'slug' => 'inoi',
                        ],
                    ]
                ],
                'photoapparati' => [
                    'name' => 'Фотоаппараты',
                    'products' => [
                        [
                            'name' => 'Canon',
                            'description' => 'Фотоаппарат Canon',
                            'slug' => 'canon',
                        ],[
                            'name' => 'Nikon',
                            'description' => 'Фотоаппарат Nikon',
                            'slug' => 'nikon',
                        ],[
                            'name' => 'Pentax',
                            'description' => 'Фотоаппарат Pentax',
                            'slug' => 'pentax',
                        ],
                    ]
                ],
                'televizory' => [
                    'name' => 'Телевизоры',
                    'products' => [
                        [
                            'name' => 'DEXP',
                            'description' => 'Телевизор DEXP',
                            'slug' => 'dexp',
                        ], [
                            'name' => 'KIVI',
                            'description' => 'Телевизор KIVI',
                            'slug' => 'kivi',
                        ], [
                            'name' => 'Prestigio',
                            'description' => 'Телевизор Prestigio',
                            'slug' => 'prestigio',
                        ], [
                            'name' => 'Sony',
                            'description' => 'Телевизор Sony',
                            'slug' => 'sony',
                        ],
                    ]
                ]
            ]
        ];

        $this->seedNestedSetCategories($this->prepareArrayForCategories($array));
        $this->seedManufacturers();
        $this->seedSellers();
        $this->seedProducts($this->prepareArrayForProducts($array));
        $this->seedDiscounts();

    }

    protected function seedManufacturers()
    {
        Manufacturer::factory(20)->create();
    }

    protected function seedSellers()
    {
        Seller::factory(20)->create();
    }

    protected function seedDiscounts()
    {
        app(DiscountSeeder::class)->run();
    }

    protected function prepareArrayForProducts($array, $category = '', $path = '')
    {
        $products = collect();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if ($key === 'products') {
                    $tmp = collect($value)->each(function ($item, $key) use ($category, $path, &$products) {
                        $products->push([$item['slug'] => $this->prepareProduct($item, $category, $path)]);
                    });
                } else {
                    $products->push($this->prepareArrayForProducts($value, $key, $path . '/' . $key));
                }

            }
        }
        $products = $products->mapWithKeys(function ($item, $key) {
            if (is_array($item)) {
                $tmp = [];
                foreach ($item as $k => $v) {
                    $tmp[$k] = $v;
                }
                return $tmp;
            }
            return $item;
        });
        return $products->toArray();
    }

    private function prepareProduct($item, $category, $path = '')
    {
        return [
            'name' => $item['name'],
            'description' => $item['description'],
            'slug' => $category.'_'.$item['slug'],
            'category_id' => Category::firstWhere('slug', $category)->id,
            'sort_index' => random_int(1, 20),
            'sales_count' => random_int(1, 300),
            'manufacturer_id' => Manufacturer::all()->random()->id,
            'main_img_id' => Attachment::factory($this->prepareAttachment('products/images/' . $path . '/' . $item['slug'] . '/main.jpg', date('Y/m/d') . '/'))->create()->id,
            'limited_edition' => random_int(0, 1),
        ];
    }

    protected function seedNestedSetCategories($categories)
    {
        foreach ($categories as $node) {
            $result[] = Category::create($node);
        }
    }

    public function prepareArrayForCategories($categories, $path = '')
    {
        return collect($categories)->mapWithKeys(function ($category, $slug) use ($path) {
            $result = [
                'name' => $category['name'],
                'slug' => $slug,
                'icon_id' => Attachment::factory($this->prepareAttachment('categories/icons' . $path . '/' . $slug . '/main.svg', 'icons/'))->create()->id,
                'is_active' => 1,
                'sort_index' => 33,
                'image_id' => Attachment::factory($this->prepareAttachment('categories/images' . $path . '/' . $slug . '/main.jpg', 'icons/'))->create()->id,
                'children' => []
            ];

            foreach ($category as $key => $value) {
                if (is_array($value) && $key !== 'products') {
                    array_push($result['children'], $this->prepareArrayForCategories([$key => $value], $path . '/' . $slug));
                }
            }

            $result['children'] = collect($result['children'])->mapWithKeys(function ($item, $key) {
                $tmp = [];
                foreach ($item as $k => $v) {
                    $tmp[$k] = $v;
                }
                return $tmp;
            })->toArray();

            return [$slug => $result];
        })->toArray();
    }

    protected function seedAdditionalImgsForProduct($product)
    {
        $attachments = array_map(function ($attachment) use ($product) {
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

    protected function seedProducts($products)
    {
        foreach ($products as $product) {
            $this->createProduct($product);
        }
    }

    public function createProduct(array $product)
    {
        $product = Product::factory($product)->create();

//        $this->seedAdditionalImgsForProduct($product);
        $this->seedSellersAndPricesForProduct($product);
    }

    protected function seedSellersAndPricesForProduct(Product $product)
    {
        //Продавцы, цены
        Seller::all()->random(3)->each(function ($seller, $key) use ($product) {
            Price::factory(['price' => rand(100, 1000)])
                ->for($seller)
                ->for($product)
                ->create();
        });

    }

    protected function prepareAttachment(string $pathToFile, string $pathToSave)
    {
        $basePath = resource_path('img/seeders/rachkov/' . $pathToFile);

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
}
