<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;

class Seller extends Model
{
    use HasFactory;
    use Attachable;

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

}
