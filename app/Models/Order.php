<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

       // Un pedido tiene muchas prendas a través de la tabla intermedia OrderClothe
       public function clothes()
       {
           return $this->belongsToMany(Clothe::class, 'order_clothes')
                       ->withPivot('size_id', 'total')
                       ->withTimestamps();
       }

       // Un pedido tiene muchos OrderClothes (relación directa)
       public function orderClothes()
       {
           return $this->hasMany(OrderClothe::class);
       }

       public function user()
        {
            return $this->belongsTo(User::class);
        }
}
