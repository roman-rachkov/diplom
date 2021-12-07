<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kalnoy\Nestedset\NodeTrait;
use Orchid\Attachment\Models\Attachment;
use App\Traits\FlushTagCache;
use Orchid\Filters\Filterable;

class Category extends Model
{
    use HasFactory, NodeTrait, FlushTagCache, SoftDeletes, Filterable;

    public static $tagsArr = ['categories'];

    public $guarded = [];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'name',
        'parent_id',
        'created_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'parent_id',
        'created_at',
        'deleted_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->hasOne(Attachment::class, 'id', 'image_id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function characteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class);
    }

    public function discountGroups()
    {
        return $this->morphToMany(DiscountGroup::class, 'discount_groupable');
    }

    public function icon()
    {
        return $this->hasOne(Attachment::class, 'id', 'icon_id');
    }

}
