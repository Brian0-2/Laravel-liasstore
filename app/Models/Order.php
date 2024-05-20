<?php

namespace App\Models;

use App\Models\OrderClothes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

       // Un pedido tiene muchas prendas a través de la tabla intermedia OrderClothe
       public function clothes()
       {
           return $this->belongsToMany(Clothe::class, 'order_clothes')
                       ->withTimestamps();
       }

       // Un pedido tiene muchos OrderClothes (relación directa)
       public function orderClothes()
       {
           return $this->hasMany(OrderClothes::class);
       }

       public function user()
        {
            return $this->belongsTo(User::class);
        }
}
