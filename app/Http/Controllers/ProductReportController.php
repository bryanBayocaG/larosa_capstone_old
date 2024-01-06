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
        return view("admin.reportSingleItem", compact("items"));
    }
    public function filterSingleItem(Request $request)
    {
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



        return view('admin.reportSingleItem', compact('items'));
    }
}
