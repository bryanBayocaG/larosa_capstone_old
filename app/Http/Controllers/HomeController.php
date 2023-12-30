<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            if($usertype == 'admin' || $usertype == 'staff')
            {
                /* $totalApparel = Products::count(); */
                $totalCategory = Category::count();
                $totalColors = Color::count();
                $totalSizes = Size::count();
                return view('admin.home',compact('totalCategory','totalColors','totalSizes'));
            }
            else
            {
                return redirect()->back();
            }
        }
    }
    
}