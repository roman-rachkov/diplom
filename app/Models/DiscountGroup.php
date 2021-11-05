<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function discount()
    {
        return $this->hasOne(Discount::class, 'discount_group_id');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'discount_groupable');
    }

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'discount_groupable');
    }


}
