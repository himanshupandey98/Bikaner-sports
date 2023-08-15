<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    // payment status
    const PAID = 1;
    const UNPAID = 0; //null is also unpaid

    //  order status
    const PENDING = 0;
    const DISPATCHED = 1;
    const DELIVERED = 2;
    const CANCELLED = 3;

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
