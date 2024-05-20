<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Clothe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderClothes extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function clothe()
    {
        return $this->belongsTo(Clothe::class);
    }
}
