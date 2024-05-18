<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Clothe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function photos() {
       return $this -> hasMany(Photo::class);
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'clothes_sizes')->withTimestamps();
    }

    public function colors(){
        return $this -> hasMany(Color::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_clothes')
                    ->withPivot('size_id', 'amount_total')
                    ->withTimestamps();
    }

    // Una prenda tiene muchas OrderClothes (relación directa)
    public function orderClothes()
    {
        return $this->hasMany(OrderClothe::class);
    }
}
