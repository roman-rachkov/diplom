<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Orchid\Attachment\Models\Attachment;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $svgName = $this->faker->numberBetween(1,7) . '.svg';
        return [
            'name' => 'image',
            'original_name' => 'image_' . $this->faker->numberBetween(1,300),
            'mime' => 'image/jpeg',
            'extension' => '__',
            'size' => 2000,
            'sort' => $this->faker->numberBetween(1,100),
            'path' => 'assets/img/icons/departments/' . $svgName,
            'description' => 'some image',
            'alt' => $svgName,
            'hash' => Hash::make('image'),
            'disk' => '__',
            'user_id' => User::all()->random()->id,
            'group' => 'anonymous'
        ];
    }
}
