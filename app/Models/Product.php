<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Models\Attachmentable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, Attachable, FlushTagCache, Filterable, SoftDeletes, AsSource;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'full_description',
        'category_id',
        'limited_edition',
        'manufacturer_id',
        'main_img_id'
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'name'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'created_at',
        'deleted_at',
    ];

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
        return $this->belongsToMany(Seller::class, 'prices');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'main_img_id');
    }

    public function additionalImages()
    {
        return $this->morphMany(Attachmentable::class, 'attachmentable');
    }

    public function scopeFindByCategorySlug($query, $slug)
    {
        return $query->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function characteristicValues(): HasMany
    {
        return $this->hasMany(CharacteristicValue::class);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function discounts()
    {
        return $this->morphToMany(Discount::class, 'discountable');
    }

    public function comparedProducts(): HasMany
    {
        return $this->hasMany(ComparedProduct::class);
    }
}
