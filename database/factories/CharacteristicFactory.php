<?php

namespace Database\Factories;

use App\Models\Characteristic;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacteristicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Characteristic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $characteristics =
            [
                ['processor frequency','Ghz'],
                ['camera resolution','Mp'],
                ['memory','Gb'],
                ['screen type', null],
                ['disk type', null]
            ];
         $characteristic =  $characteristics[rand(0, count($characteristics)-1)];

        return [
            'name' => $characteristic[0],
            'measure' => $characteristic[1],
        ];
    }
}
