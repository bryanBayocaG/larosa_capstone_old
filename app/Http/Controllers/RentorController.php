<?php

namespace App\Http\Controllers;

use App\Models\RentInfo;
use Illuminate\Http\Request;

class RentorController extends Controller
{
    public function index()
    {
        $rentors = RentInfo::all();
        $renting = RentInfo::where('status', 'Renting')->get();
        $overdue = RentInfo::where('status', 'Overdue')->get();
        $returned = RentInfo::where('status', 'Returned')->get();
        return view('admin.rentorList', compact('rentors', 'renting', 'overdue', 'returned'));
    }
}
