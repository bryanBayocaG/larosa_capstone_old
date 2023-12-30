<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\included_item;
use App\Models\item;
use App\Models\Item_details;
use App\Models\payment;
use App\Models\product_set;
use App\Models\rentedItem;
use App\Models\RentInfo;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class RentoutController extends Controller
{
    public function index()
    {
        $categ = Category::all();
        // $combi =  Category::with('products')->get();
        $cart = Cart::instance('shopping')->content();
        $sets = product_set::all();


        return view('admin.renting', compact('categ', 'cart', 'sets'));
    }
    public function checkout(Request $request)
    {
        $tot = Cart::instance('shopping')->priceTotal();
        $totalPrice = str_replace(',', '', $tot);
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'contactnum' => 'required|string|max:255',
            'eventdate' => 'required|date',
            'address' => 'required|string|max:255',
            'payment' => 'required|string|max:255'
        ]);

        $order = new RentInfo();
        $randomCode = Str::random(10);

        $order->transac_code = $randomCode;
        $order->first_name = $request->input('fname');
        $order->last_name = $request->input('lname');
        $order->contact_num = $request->input('contactnum');
        $order->address = $request->input('address');
        $order->rent_type = $request->input('rent_type');
        $order->event_date = $request->input('eventdate');
        $order->totalPrice = $totalPrice;

        $bayad = $request->input('payment');
        $balance = $totalPrice - $bayad;
        $order->balance = $balance;

        $eventDate = Carbon::parse($request->input('eventdate'));
        $returnDate = $eventDate->addDays(3);
        $order->return_date = $returnDate;
        $order->save();

        foreach (Cart::instance('shopping')->content() as $item) {
            $orderItem = new rentedItem();
            $orderItem->rent_info_id = $order->id;
            $orderItem->product_set_id = $item->id;
            $orderItem->pricing = $item->price;
            $orderItem->save();


            for ($i = 0; $i < intval($item->qty); $i++) {
                $product = product_set::find($item->id);
                if ($product) {
                    $includedItems = included_item::where('product_set_id', $product->id)->get();
                    foreach ($includedItems as $includedItem) {
                        $itemDetail = item_details::where('item_id', $includedItem->item_id)->where('status', 'in-possesion')->first();
                        if ($itemDetail) {
                            $itemDetail->set_id = $order->id;
                            $itemDetail->status = 'rented';
                            $itemDetail->save();
                        }
                    }
                }
            }
        };

        $payment = new payment();
        $payment->rent_info_id = $order->id;
        $payment->payments = $request->input('payment');
        $payment->remarks = $request->input('remarks');
        $payment->save();



        $apiKey = 'da96e8b9124390d6e9a85bfc253e6cea';
        $number = $request->input('contactnum');
        $cleanedNumber = str_replace('-', '', $number);
        $itemNames = '';
        foreach (Cart::instance('shopping')->content() as $item) {
            $itemName = $item->name;
            $itemNames .= ($itemNames ? ', ' : '') . $itemName;
        }
        $customerFName = $request->input('fname');
        $customerLName = $request->input('lname');
        $message = "Hello " . $customerFName . " " . $customerLName . " as of " . now() . ", you rented the following item(s) [" . $itemNames . "] with a total of " . $tot . ", and paid by the amount of " . $bayad . ", Thank you for renting in Larosa";


        // $client = new Client();
        // $client->post('https://semaphore.co/api/v4/messages', [
        //     'form_params' => [
        //         'apikey' => $apiKey,
        //         'number' => $cleanedNumber,
        //         'message' => $message,
        //         'sendername' => 'LAROSA',
        //     ],
        //     'verify' => false,
        // ]);
        Cart::instance('shopping')->destroy();
        return redirect()->back()->with('message', 'Apparel checked out succesfully!');
    }
}
