<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsService extends Model
{
    use HasFactory, FlushTagCache;

    static array $tagsArr = ['paymentService'];

    protected $guarded = [];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
