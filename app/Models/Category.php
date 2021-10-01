<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Orchid\Attachment\Models\Attachment;
use App\Traits\FlushTagCache;

class Category extends Model
{
    use HasFactory, NodeTrait, FlushTagCache, SoftDeletes;

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
