<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class included_item extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(item::class, 'item_id');
    }
}