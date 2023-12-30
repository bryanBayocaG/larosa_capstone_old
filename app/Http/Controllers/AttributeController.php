<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\ItemCategory;
use App\Models\Size;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $ItemCateg = ItemCategory::all();
        return view('admin.attributes', compact('categories', 'colors', 'sizes', 'ItemCateg'));
    }
}
