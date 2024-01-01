<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_details extends Model
{
    use HasFactory;
    public function item()
    {
        return $this->belongsTo(item::class);
    }
    public function item_detail()
    {
        return $this->belongsTo(item::class, 'item_id');
    }
}
