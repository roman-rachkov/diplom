<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Discount extends Model
{
    use HasFactory, AsSource, SoftDeletes, FlushTagCache;

    public const METHOD_CLASSIC = 'classic';
    public const METHOD_SUM = 'sum';
    public const METHOD_FIXED = 'fixed';

    public const CATEGORY_OTHER = 'other';
    public const CATEGORY_SET = 'set';
    public const CATEGORY_CART = 'cart';

    public static $tagsArr = [
        'discounts',
        'products',
        'categories'
    ];

    protected $fillable = [
        'value',
        'method_type',
        'category_type',
        'weight',
        'minimum_qty',
        'maximum_qty',
        'minimal_cost',
        'maximum_cost',
        'start_at',
        'end_at',
        'is_active',
        'description',
        'image_id',
        'title'
    ];

    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    public function discountGroups(): HasMany
    {
        return $this->hasMany(DiscountGroup::class);
    }

    static function getConstants()
    {
        return collect((new \ReflectionClass(__CLASS__))->getConstants());
    }

    static function getMethodTypes()
    {
        return static::getConstants()->filter(function ($value, $key) {
            return !(false === stripos($key, 'METHOD'));
        });
    }

    static function getCategoryTypes()
    {
        return static::getConstants()->filter(function ($value, $key) {
            return !(false === stripos($key, 'CATEGORY'));
        });
    }

    static function defaultConstants()
    {
        return [
            'CREATED_AT',
            'UPDATED_AT',
            'DELETED_AT'
        ];
    }

    public function image(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'image_id');
    }
}
