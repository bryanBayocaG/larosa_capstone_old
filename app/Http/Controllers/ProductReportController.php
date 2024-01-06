<?php

namespace App\Http\Controllers;

use App\Models\Item_details;
use Illuminate\Http\Request;

class ProductReportController extends Controller
{
    public function reportSingleItem()
    {
        $items = Item_details::all();
        return view("admin.reportSingleItem", compact("items"));
    }
}
