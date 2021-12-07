<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Order extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'full_name',
        'email',
        'phone',
        'local_delivery_type',
        'total',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'full_name',
        'email',
        'phone',
        'delivery_type',
        'total',
        'created_at',
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = str_replace(['+7', '(', ')', '-', ' '], '', $value);
    }

    public function getLocalDeliveryTypeAttribute()
    {
        return __('admin.orders.delivery_type.' . $this->delivery_type);
    }

}
