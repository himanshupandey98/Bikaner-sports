<?php

namespace App\Models;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function variant(){
        return $this->belongsTo(ProductVariant::class,'product_variant_id','id');
    }
}
