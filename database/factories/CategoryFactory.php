<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    protected $categoryNames;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryNames = [
            'Accessories',
            'Bags',
            'Cameras',
            'Clothing',
            'Electronics',
            'Fashion',
            'Furniture',
            'Mobile',
            'Trends',
            'More'
        ];

        $icon = Attachment::factory()->create($this->getIcons()->random());

        return [
            'name' => $this->faker->randomElement($categoryNames),
            'slug' => $this->faker->word(),
            'icon_id' => $icon->id,
            'sort_index' => $this->faker->numberBetween(0, 101),
            'is_active' => $this->faker->boolean(90),
            'image_id' => Attachment::factory()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            $categories = Category::where('is_active', 1)->get();
            if (
                $this->faker->boolean(70) &&
                $categories->isNotEmpty()
            ) {
                $parent = $categories->random();
                $category->refresh();
                if (!$parent->isSelfOrDescendantOf($category)) {
                    $parent->appendNode($category);
                }
            }
        });
    }

    protected function getAttachmentAttrsForIcon(string $img): array
    {
        $basePath = resource_path('img/icons/categories/' . $img);

        if (file_exists($basePath)) {
            $path = 'icons/';
            $storagePath = Storage::disk('public')->putFile($path, new File($basePath));

            $file = new File(Storage::disk('public')->path($storagePath));
            return [
                'name' => explode('.', $file->getBasename())[0],
                'original_name' => $file->getBasename(),
                'mime' => $file->getMimeType(),
                'extension' => $file->getExtension(),
                'size' => $file->getSize(),
                'path' => $path,
                'alt' => $img,
                'hash' => $file->hashName(),
                'user_id' => 1,
            ];
        }
        throw new FileNotFoundException('File ' . $basePath . ' not found', 404);
    }

    public function getIcons(): Collection
    {
        return collect([
            'audio_system.svg',
            'camera.svg',
            'discount.svg',
            'headset.svg',
            'kettle.svg',
            'lamp.svg',
            'microwave.svg',
            'mixer.svg',
            'oven.svg',
            'smartphone.svg',
            'tv.svg',
            'washer.svg'
        ])->map(function ($img) {
            return $this->getAttachmentAttrsForIcon($img);
        });
    }

}
