<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Discount extends Model
{
    use HasFactory, AsSource;

    public const CLASSIC = 'classic';
    public const SUM = 'sum';
    public const FIXED = 'fix';

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'discountable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'discountable');
    }
}
