<?php

namespace App\Http\Controllers;

use App\Models\Item_details;
use App\Models\Item_quantity;
use App\Models\product_set;
use App\Models\rentedItem;
use App\Models\RentInfo;
use App\Models\ItemMovements;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function returnSingle(Request $request)
    {
        $rentInfoID = $request->input('rentInfoID');
        $rentQuan = $request->input('rentQuantity');
        $itemID = $request->input('item_id');

        $rentedItemSingle = rentedItem::where('rent_info_id', $rentInfoID)
            ->where('product_set_id', null)
            ->where('status', 'Rented')
            ->where('single_item_id', $itemID)->get();
        foreach ($rentedItemSingle as $item) {
            $item->status = 'Returned';
            $item->save();
        };


        $quantityBack = Item_quantity::find($itemID);
        if ($quantityBack) {
            $quantityBack->remaining = $quantityBack->remaining + $rentQuan;
            $quantityBack->save();
        }

        $itemDetailsBack = Item_details::where('item_id', $itemID)
            ->where('set_id', $rentInfoID)
            ->where('set_id2', 0)
            ->where('status', 'Rented')->get();
        foreach ($itemDetailsBack as $itemDetail) {
            $itemDetail->set_id = 0;
            $itemDetail->status = 'in-possesion';
            $itemDetail->save();

            $itemMove = new ItemMovements();
            if ($itemMove) {
                $itemMove->item_id = $itemDetail->id;
                $itemMove->status = "Returned";
                $itemMove->save();
            }
        }


        $rentedI = rentedItem::where('rent_info_id', $rentInfoID)->where('status', 'Rented')->count();
        if ($rentedI === 0) {
            $Sitem = RentInfo::find($rentInfoID);
            if ($Sitem) {
                $Sitem->status = "Returned";
                $Sitem->save();
            }
            session()->flash('success', 'Fully Returned');
            return redirect()->back();
        }
        session()->flash('success', 'Partially Returned');

        return redirect()->back();
    }

    public function returnSingleRentCondition(Request $request)
    {
        $itemID = $request->input('item');
        $condition = $request->input('condition');

        $item = Item_details::find($itemID);
        $item->state = $condition;
        $item->save();
    }

    public function returnSet(Request $request)
    {
        $rentInfoID = $request->input('rentInfoID');
        $rentQuan = $request->input('rentQuantity');
        $setID = $request->input('set_id');

        $rentedItemSingle = rentedItem::where('rent_info_id', $rentInfoID)
            ->where('product_set_id', $setID)
            ->where('status', 'Rented')
            ->where('single_item_id', null)->get();
        foreach ($rentedItemSingle as $item) {
            $item->status = 'Returned';
            $item->save();
        };


        $itemDetailsBack = Item_details::where('set_id', $rentInfoID)
            ->where('set_id2', $setID)
            ->where('status', 'Rented')->get();
        foreach ($itemDetailsBack as $itemDetail) {
            $itemDetail->set_id = 0;
            $itemDetail->status = 'in-possesion';
            $itemDetail->save();
        }

        $quantityBack = product_set::find($setID);
        if ($quantityBack) {
            $quantityBack->remaining = $quantityBack->remaining + $rentQuan;
            $quantityBack->save();
        }


        $rentedI = rentedItem::where('rent_info_id', $rentInfoID)->where('status', 'Rented')->count();
        if ($rentedI === 0) {
            $Sitem = RentInfo::find($rentInfoID);
            if ($Sitem) {
                $Sitem->status = "Returned";
                $Sitem->save();
            }
            session()->flash('success', 'Fully Returned');
            return redirect()->back();
        }
        session()->flash('success', 'Partially Returned');

        return redirect()->back();
    }
}