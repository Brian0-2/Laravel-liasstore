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
}
