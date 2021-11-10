<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Review extends Model
{
    use HasFactory, FlushTagCache, AsSource, Filterable;

    protected $guarded = [];

    public static $tagsArr = ['reviews'];

    protected $appends = ['comment_date'];

    protected $allowedSorts = [
        'created_at',
    ];

    protected $allowedFilters = [
        'review',
    ];

    public function getCommentDateAttribute()
    {
        return Carbon::create($this->created_at)
            ->locale(config('app.locale'))
            ->isoFormat('H:mm - D MMMM YYYY');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
