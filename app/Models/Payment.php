<?php

namespace App\Models;

use App\Traits\FlushTagCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, FlushTagCache;

    protected $guarded = [];

    static array $tagsArr = ['paymentService'];

    public function paymentsService()
    {
        return $this->belongsTo(PaymentsService::class);
    }
}
