<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductReportController extends Controller
{
    public function reportSingleItem()
    {
        return view("admin.reportSingleItem");
    }
}
