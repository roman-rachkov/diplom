<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

class Seller extends Model
{
    use HasFactory;
    use Attachable;

    public function logo()
    {
        return $this->hasOne(Attachment::class, 'id', 'logo_id');
    }

}
