<?php

namespace App\Http\Controllers;

use App\Models\Item_details;
use App\Models\RentInfo;
use Illuminate\Http\Request;

class ProductReportController extends Controller
{
    public function reportSingleItem()
    {
        $items = Item_details::all();
        $totalItems = Item_details::count();
        $totalRented = Item_details::where('status', 'Rented')->count();
        $totalAvailable = Item_details::where('status', 'in-possesion')->where('set_id', 0)->where('set_id2', 0)->count();
        return view("admin.reportSingleItem", compact("items", 'totalItems', 'totalRented', 'totalAvailable'));
    }
    public function filterSingleItem(Request $request)
    {
        $totalItems = Item_details::count();
        $totalRented = Item_details::where('status', 'Rented')->count();
        $totalAvailable = Item_details::where('status', 'in-possesion')->where('set_id', 0)->where('set_id2', 0)->count();
        $setVal = intval($request->setVal);
        $state = $request->state;



        // $rentors = RentInfo::whereDate('return_date', '>=', $start_date)
        //     ->whereDate('return_date', '<=', $end_date)
        //     ->get();
        $usersQuery = Item_details::query();


        if ($setVal != 0) {
            if ($setVal === 1) {
                $usersQuery->where('set_id2', '>', 0);
            } else {
                $usersQuery->where('set_id2', '===', 0);
            }
        }
        if ($state != 'none') {
            if ($state === 'Rented') {
                $usersQuery->where('status', $state);
            }
            if ($state === 'Available') {
                $usersQuery->where('set_id2', '===', 0)->where('status', 'in-possesion');
            }
            if ($state === 'Overdue') {
                $usersQuery->where('status', '===', 'Overdue');
            }
        }

        $items = $usersQuery->get();



        return view('admin.reportSingleItem', compact('items', 'totalItems', 'totalRented', 'totalAvailable'));
    }
}
