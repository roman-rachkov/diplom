<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Orchid\Attachment\Models\Attachment;

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

    public function getIcons(): Collection
    {
        return  collect([
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
        ])->map(function ($img){
            return $this->getAttachmentAttrsForIcon($img);
        });
    }

}
