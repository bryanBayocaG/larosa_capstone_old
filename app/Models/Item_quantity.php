<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_quantity extends Model
{
    use HasFactory;
    public function item()
    {
        return $this->belongsTo(item::class);
    }
}
