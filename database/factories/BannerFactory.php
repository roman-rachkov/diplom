<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchid\Attachment\Models\Attachment;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'subtitle' => $this->faker->sentence(15),
            'button_text' => 'Подробнее',
            'href' => $this->faker->url(),
            'is_active' => $this->faker->boolean,
            'image_id' => Attachment::all()->random()->id
        ];
    }

}
