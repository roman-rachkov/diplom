<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

//    public function getServiceAttribute()
//    {
//        return app($this->service);
//    }

}
