<?php

namespace App\Models;

use Illuminate\Cache\HasCacheLock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Kalnoy\Nestedset\NodeTrait;
use Orchid\Attachment\Models\Attachment;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    public $guarded = [];

    protected static function booted()
    {
        static::updated(function () {
            Cache::forget('categories');
        });
        static::created(function () {
            Cache::forget('categories');
        });

        static::saved(function () {
            Cache::forget('categories');
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->hasOne(Attachment::class, 'id', 'image_id');
    }

}
