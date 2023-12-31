<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Color;
use App\Models\item;
use App\Models\Item_details;
use App\Models\ItemCategory;
use App\Models\Size;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            if ($usertype == 'admin' || $usertype == 'staff') {
                $totalApparel = Item_details::count();
                $totalRented = Item_details::where('status', 'Rented')->count();
                $totalCategory = Category::count() + ItemCategory::count();
                $totalColors = Color::count();
                $totalSizes = Size::count();
                return view('admin.home', compact('totalCategory', 'totalColors', 'totalSizes', 'totalApparel', 'totalRented'));
            } else {
                return redirect()->back();
            }
        }
    }
}
