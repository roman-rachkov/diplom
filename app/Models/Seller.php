<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;

class Seller extends Model
{
    use HasFactory, Attachable, FlushTagCache, SoftDeletes, Filterable;

    public $guarded = [];

    public static $tagsArr = [
        'sellers',
        'prices',
        'products'
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'name',
        'phone',
        'email',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'phone',
        'email',
        'created_at',
    ];


    public function logo()
    {
        return $this->hasOne(Attachment::class, 'id', 'logo_id');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

}
