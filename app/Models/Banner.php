<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Banner extends Model
{
    use HasFactory, AsSource, Attachable, Filterable, FlushTagCache, SoftDeletes;

    public static $tagsArr = ['banners'];

    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'href',
        'is_active',
        'image_id',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'title',
        'is_active',
        'created_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'title',
        'is_active',
        'created_at',
        'deleted_at',
    ];

    public function image()
    {
        return $this->hasOne(Attachment::class, 'id', 'image_id');
    }
}
