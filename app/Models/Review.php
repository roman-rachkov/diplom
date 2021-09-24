<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['comment_date'];

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
