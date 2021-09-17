<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cart()
    {
        return $this->items()->where('order_id', null);

//        return $this->orders()->whereHas('payment', function (Builder $query) {
//            $query->where('payed_at', null);
//        })->with('items');
    }
}
