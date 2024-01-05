<?php

namespace App\Http\Controllers;

use App\Models\item;
use Illuminate\Http\Request;

class PublicShowController extends Controller
{
    public function singleItem($code)
    {

        $singItem = item::where('item_code', $code)->get();

        return view('admin.publicSingle', compact('singItem'));
    }
}
