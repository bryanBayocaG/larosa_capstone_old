<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\product_set;
use Illuminate\Http\Request;

class PublicShowController extends Controller
{
    public function singleItem($code)
    {

        $singItem = item::where('item_code', $code)->get();
        return view('admin.publicSingle', compact('singItem'));
    }
    public function setItem($code)
    {

        $singItem = product_set::where('set_code', $code)->get();
        return view('admin.publicSet', compact('singItem'));
    }
}