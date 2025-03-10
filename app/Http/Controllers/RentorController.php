<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Models\rentedItem;
use App\Models\RentInfo;
use App\Models\SetTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentorController extends Controller
{
    public function index()
    {
        
        $rentors = RentInfo::all();
        $overDuerent = RentInfo::where('status', 'Overdue')->count();
        $withBalance = RentInfo::where('balance', '>', 0.00)->count();
        $firstSetTime = SetTime::first();

        if ($firstSetTime) {
       
            $setTimeValue = $firstSetTime->set_time;
        } else {
         
            $setTimeValue = null; 
        }
        return view('admin.rentorList', compact('rentors', 'overDuerent', 'withBalance','setTimeValue'));
    }

    public function detailP($id)
    {
        $rentor = RentInfo::find($id);
        $payments = payment::where('rent_info_id', $id)->get();
        $rentedItems = rentedItem::where('rent_info_id', $id)/* ->where('status', 'Rented') */->get();
        return view('admin.rentorDetail', compact('rentor', 'payments', 'rentedItems', 'id'));
    }
    public function pay(Request $request)
    {
        $binayad = $request->input('payment');
        $currentBal = $request->input('currentBal');
        $balance = $currentBal - $binayad;

        $payment = new payment();
        $payment->rent_info_id = $request->input('rentid');
        $payment->payments = $request->input('payment');
        $payment->remarks = $request->input('remarks');
        $payment->save();

        $rentInfoUpdate = RentInfo::find($request->input('target'));
        $rentInfoUpdate->balance = $request->input('currentBal') - $request->input('payment');
        $rentInfoUpdate->save();



        $apiKey = 'da96e8b9124390d6e9a85bfc253e6cea';
        $number = $request->input('tagerNum');
        $cleanedNumber = str_replace('-', '', $number);
        $message = 'As of ' . now() . ' you paid your balance with a total of ₱ ' . $binayad . ' .00. with remaing balance of ₱ ' . $balance . '.00.';
        $client = new Client();
        $client->post('https://semaphore.co/api/v4/messages', [
            'form_params' => [
                'apikey' => $apiKey,
                'number' => $cleanedNumber,
                'message' => $message,
                'sendername' => 'LAROSA',
            ],
            'verify' => false,
        ]);


        return redirect()->back()->with('success', 'Payment added successfully.');
    }

    public function setTime(Request $request)
    {
      
        $existingTime = SetTime::first(); 

        if ($existingTime) {
            $existingTime->set_time = $request->input('time');
            $existingTime->save();
        } else {
            $newTime = new SetTime();
            $newTime->set_time = $request->input('time');
            $newTime->save();
        }
    
        return redirect()->back()->with('success', 'Time Updated.');
    }
}
