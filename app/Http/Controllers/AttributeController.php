<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\item;
use App\Models\ItemCategory;
use App\Models\product_set;
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
    public function delete_category($id)
    {
        $productCount = product_set::where('category_id', $id)->count();
        if ($productCount > 0) {
            return redirect()->back()->with('message', 'Cannot delete because it has child.');
        } else {
            $post = Category::find($id);
            // $post->delete();
            return redirect()->back()->with('message', 'Set Category Deleted Succesfully');
        }
    }
    public function delete_category2($id)
    {
        $productCount = item::where('item_category_id', $id)->count();
        if ($productCount > 0) {
            return redirect()->back()->with('message', 'Cannot delete because it has child.');
        } else {
            $post = ItemCategory::find($id);
            $post->delete();
            return redirect()->back()->with('message', 'Item Category Deleted Succesfully');
        }
    }
    public function delete_color($id)
    {
        $productVarCount = item::where('color_id', $id)->count();
        $setCount = product_set::where('color_id', $id)->count();
        if ($productVarCount > 0 || $setCount > 0) {
            return redirect()->back()->with('message', 'Cannot delete because it has child.');
        } else {
            $post = Color::find($id);
            // $post->delete();
            return redirect()->back()->with('message', 'Color Deleted Succesfully');
        }
    }
    public function delete_size($id)
    {
        $productVarCount = product_set::where('size_id', $id)->count();
        if ($productVarCount > 0) {
            return redirect()->back()->with('message', 'Cannot delete because it has child.');
        } else {
            $post = Size::find($id);
            $post->delete();
            return redirect()->back()->with('message', 'Size Deleted Succesfully');
        }
    }
}
