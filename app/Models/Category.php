<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Orchid\Attachment\Models\Attachment;
use App\Traits\FlushTagCache;

class Category extends Model
{
    use HasFactory, NodeTrait, FlushTagCache;

    public static $tagsArr = ['categories'];

    public $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->hasOne(Attachment::class, 'id', 'image_id');
    }

}
