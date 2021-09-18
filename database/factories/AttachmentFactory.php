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

    public function definition()
    {
        $datePath = \Illuminate\Support\Carbon::now()->format('Y/m/d/');
        $dir = storage_path('app/public/' . $datePath) ;
        if(!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $image = $this->faker->image($dir,640,480, null, false);
        list($name, $extension) = explode('.', $image);
        return [
            'name' => $name,
            'original_name' => $image,
            'mime' => mime_content_type($dir . '/' . $image),
            'extension' => $extension,
            'size' => stat($dir . '/' . $image)['size'],
            'sort' => 0,
            'path' => $datePath,
            'description' => $this->faker->sentence(),
            'alt' => $image,
            'hash' => Hash::make($name),
            'disk' => 'public',
            'user_id' => User::all()->random(),
            'group' => 0
        ];
    }

}
