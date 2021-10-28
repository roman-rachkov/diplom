<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
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

    public function definition()
    {
        $datePath = \Illuminate\Support\Carbon::now()->format('Y/m/d/');
        $filepath = storage_path('app/public/' . $datePath);
        if(!File::exists($filepath)){
            File::makeDirectory($filepath);
        }
        $image = $this->faker->image($filepath,640,480, null, false, $word = null);

        list($name, $extension) = explode('.', $image);
        return [
            'name' => $name,
            'original_name' => $image,
            'mime' => mime_content_type($filepath . '/' . $image),
            'extension' => $extension,
            'size' => stat($filepath . '/' . $image)['size'],
            'sort' => 0,
            'path' => $datePath,
            'description' => $this->faker->sentence(),
            'alt' => $image,
            'hash' => Hash::make($name),
            'disk' => 'public',
            'user_id' => User::factory(),
            'group' => 0
        ];
    }

}
