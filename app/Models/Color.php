<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(item::class);
    }
    public function prodSet()
    {
        return $this->hasMany(product_set::class);
    }
}
