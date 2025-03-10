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
use App\Models\product_set;
use App\Models\RentInfo;
use App\Models\Size;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            if ($usertype == 'admin' || $usertype == 'staff') {
                $totalItem = Item_details::count();
                $totalAvailableItem = Item_details::where('status', 'in-possesion')->where('set_id2', 0)->count();
                $totalCategory = Category::count() + ItemCategory::count();;
                $totalColors = Color::count();
                $totalSizes = Size::count();
                $rentors = RentInfo::all();
                $setNum = product_set::where('stash', null)->sum('quantity');
                $setRemain = product_set::sum('remaining');
                $overDuerent = RentInfo::where('status', 'Overdue')->count();
                $withBalance = RentInfo::where('balance', '>', 0.00)->count();

                $currentYear = Carbon::now()->year;

                $janSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 1)->sum('totalPrice');
                $febSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 2)->sum('totalPrice');
                $marSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 3)->sum('totalPrice');
                $aprSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 4)->sum('totalPrice');
                $maySum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 5)->sum('totalPrice');
                $junSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 6)->sum('totalPrice');
                $julSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 7)->sum('totalPrice');
                $augSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 8)->sum('totalPrice');
                $sepSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 9)->sum('totalPrice');
                $octSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 10)->sum('totalPrice');
                $novSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 11)->sum('totalPrice');
                $decSum = RentInfo::whereYear('created_at', $currentYear)->whereMonth('created_at', 12)->sum('totalPrice');


                return view('admin.home', compact('totalCategory', 'totalColors', 'totalSizes', 'totalItem', 'totalAvailableItem', 'setNum', 'setRemain', 'rentors', 'overDuerent', 'withBalance',
                "janSum", "febSum", "marSum", "aprSum", "maySum", "junSum", "julSum", "augSum", "sepSum", "octSum", "novSum", "decSum"));
            } else {
                return redirect()->back();
            }
        }
    }

    public function setCategPage()
    {
        return view('admin.setCategPage');
    }
    public function itemCategPage()
    {
        return view('admin.itemCategPage');
    }
    public function sizePage()
    {
        return view('admin.sizePage');
    }
    public function colorPage()
    {
        return view('admin.colorPage');
    }
    public function filterDueDate(Request $request)
    {
        $Duestart_date = $request->Duestart_date;
        $Dueend_date = $request->Dueend_date;

        $Eventstart_date = $request->Eventstart_date;
        $Eventend_date = $request->Eventend_date;

        $Transactionstart_date = $request->Transactionstart_date;
        $Transactionend_date = $request->Transactionend_date;

        $withBalance = $request->withBalance;
        $withOverdue = $request->overDue;


        // $rentors = RentInfo::whereDate('return_date', '>=', $start_date)
        //     ->whereDate('return_date', '<=', $end_date)
        //     ->get();
        $rentorsQuery = RentInfo::query();

        if (!empty($Duestart_date)) {
            $rentorsQuery->whereDate('return_date', '>=', $Duestart_date);
        }
        if (!empty($Dueend_date)) {
            $rentorsQuery->whereDate('return_date', '<=', $Dueend_date);
        }

        if (!empty($Eventstart_date)) {
            $rentorsQuery->whereDate('event_date', '>=', $Eventstart_date);
        }
        if (!empty($Eventend_date)) {
            $rentorsQuery->whereDate('event_date', '<=', $Eventend_date);
        }

        if (!empty($Transactionstart_date)) {
            $rentorsQuery->whereDate('created_at', '>=', $Transactionstart_date);
        }
        if (!empty($Transactionend_date)) {
            $rentorsQuery->whereDate('created_at', '<=', $Transactionend_date);
        }
        if (!empty($withBalance)) {
            $rentorsQuery->where('balance', '>', '0.00');
        }
        if (!empty($withOverdue)) {
            $rentorsQuery->where('status', '===', 'Overdue');
        }
        $rentors = $rentorsQuery->get();

        $totalItem = Item_details::count();
        $totalAvailableItem = Item_details::where('status', 'in-possesion')->where('set_id2', 0)->count();
        $totalCategory = Category::count() + ItemCategory::count();;
        $totalColors = Color::count();
        $totalSizes = Size::count();
        $setNum = product_set::sum('quantity');
        $setRemain = product_set::sum('remaining');
        $overDuerent = RentInfo::where('status', 'Overdue')->count();
        $withBalance = RentInfo::where('balance', '>', 0.00)->count();

        return view('admin.home', compact('totalCategory', 'totalColors', 'totalSizes', 'totalItem', 'totalAvailableItem', 'setNum', 'setRemain', 'rentors', 'overDuerent', 'withBalance'));
    }
}
