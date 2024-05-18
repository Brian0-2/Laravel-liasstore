<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function clothes() {
        return $this -> belongsToMany(Clothe::class,'clothes_sizes');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_clothes')
                    ->withPivot('clothe_id', 'amount_total')
                    ->withTimestamps();
    }

    // Una talla tiene muchos OrderClothes (relación directa)
    public function orderClothes()
    {
        return $this->hasMany(OrderClothe::class);
    }
}
