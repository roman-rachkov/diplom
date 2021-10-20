<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

class Product extends Model
{
    use HasFactory, Attachable, FlushTagCache;


    public static $tagsArr = [
        'products',
        'dayOfferProduct',
        'topCatalog',
        'categories',
        'reviews',
        'prices',
        'manufacturers',
        'sellers',
        'catalog',
        'category',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function sellers(): BelongsToMany
    {
        return $this->belongsToMany(Seller::class, Price::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'main_img_id');
    }

    public function scopeFindByCategorySlug($query, $slug)
    {
        return $query->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function discounts()
    {
        return $this->morphToMany(Discount::class, 'discountable');
    }
}
