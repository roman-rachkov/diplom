<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

class Seller extends Model
{
    use HasFactory;
    use Attachable;
    use FlushTagCache;

    public $tagsArr = ['sellers'];

    public function logo()
    {
        return $this->hasOne(Attachment::class, 'id', 'logo_id');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

}
