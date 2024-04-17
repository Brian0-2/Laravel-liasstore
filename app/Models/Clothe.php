<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clothe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function photos() {
       return $this -> hasMany(Photo::class);
    }

    public function sizes(){
        return $this -> belongsToMany(Size::class,'clothes_sizes');
    }

    public function colors(){
        return $this -> hasMany(Color::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
