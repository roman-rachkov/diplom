<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    public const types = ['classic', 'sum', 'fix'];

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'discountable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'discountable');
    }
}
