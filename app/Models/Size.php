<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public function productSets()
    {
        return $this->hasMany(product_set::class);
    }
    public function items()
    {
        return $this->hasMany(item::class);
    }
}
