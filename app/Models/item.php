<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasOne(Item_details::class);
        // return $this->hasMany(Item_details::class);
    }

    public function quantity()
    {
        return $this->hasOne(Item_quantity::class);
    }
    // public function itemQuantity()
    // {
    //     return $this->hasOne(Item_quantity::class, 'item_id');
    // }

    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class);
    }
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function includedItems()
    {
        return $this->hasMany(included_item::class, 'item_id');
    }
}
