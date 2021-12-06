<?php

namespace Database\Seeders\DemoDataSeeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * run: sail artisan db:seed --class=Database\\Seeders\\DemoDataSeeders\\Pakycb84Seeder
 */
class Pakycb84Seeder extends Seeder
{
    public function run()
    {
        Category::factory([
            'name' => 'Ювелирные изделия',
            'slug' => "jewellery",
            'icon_id' => Attachment::factory($this->prepareAttachment('categories/icons/diamond.png', 'icons/')),
            'sort_index' => 0,
            'is_active' => true,
            'image_id' => Attachment::factory($this->prepareAttachment('categories/images/jewellery.jpg', date('Y/m/d'))),
        ])->has(
            Category::factory([
                'name' => 'Цепи',
                'slug' => "chains",
                'icon_id' => Attachment::factory($this->prepareAttachment('categories/icons/necklace.png', 'icons/')),
                'sort_index' => 0,
                'is_active' => true,
                'image_id' => Attachment::factory($this->prepareAttachment('categories/images/chains.jpg', date('Y/m/d'))),
            ])
        )->has(
            Category::factory([
                'name' => 'Кольца',
                'slug' => "rings",
                'icon_id' => Attachment::factory($this->prepareAttachment('categories/icons/diamond-ring.png', 'icons/')),
                'sort_index' => 0,
                'is_active' => true,
                'image_id' => Attachment::factory($this->prepareAttachment('categories/images/rings.jpg', date('Y/m/d'))),
            ])
        )->has(
            Category::factory([
                'name' => 'Подвески',
                'slug' => "pendant",
                'icon_id' => Attachment::factory($this->prepareAttachment('categories/icons/jewelry.png', 'icons/')),
                'sort_index' => 0,
                'is_active' => true,
                'image_id' => Attachment::factory($this->prepareAttachment('categories/images/pendant.jpeg', date('Y/m/d'))),
            ])
        )->has(
            Category::factory([
                'name' => 'Серьги',
                'slug' => "Earrings",
                'icon_id' => Attachment::factory($this->prepareAttachment('categories/icons/necklace.png', 'icons/')),
                'sort_index' => 0,
                'is_active' => true,
                'image_id' => Attachment::factory($this->prepareAttachment('categories/images/earrings.jpg', date('Y/m/d'))),
            ])
        )
            ->create();
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
