<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Discount extends Model
{
    use HasFactory, AsSource, SoftDeletes;

    public const METHOD_CLASSIC = 'classic';
    public const METHOD_SUM = 'sum';
    public const METHOD_FIXED = 'fixed';

    public const CATEGORY_PRODUCTS = 'products';
    public const CATEGORY_GROUPS = 'groups';
    public const CATEGORY_CART = 'cart';

    public function discountGroup()
    {
        return $this->hasOne(DiscountGroup::class);
    }

    static function getConstants()
    {
        return collect((new \ReflectionClass(__CLASS__))->getConstants());
    }

    static function getMethodTypes()
    {
        return static::getConstants()->filter(function ($value, $key){
            return !(false === stripos($key,'METHOD'));
        });
    }

    static function getCategoryTypes()
    {
        return static::getConstants()->filter(function ($value, $key){
            return !(false === stripos($key,'CATEGORY'));
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
}
