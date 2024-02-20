<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Requests\User\Checkout\Store;
use App\Mail\Checkout\AfterCheckout;
use App\Models\Camp;
use Auth;
use Mail;
//use App\Models\User;
use Str;
use Midtrans;

class CheckoutController extends Controller
{

    public function __construct()
    {
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Camp $camp)
    {
        //return $camp;
        if( $camp->is_Registered){
            $request->session()->flash('error', "You Already Registered on {$camp->title} camp.");
            return redirect(route('user.dashboard'));
        }
        return view('checkout.create',[
            'camp' => $camp
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request, Camp $camp)
    {
        //MAPPING REQUEST DATA
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['camp_id'] = $camp->id;

        //update user data
        $user = Auth::user();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->occupation = $data['occupation'];
        $user->save();

        //create checkout
        $checkout = Checkout::create($data);
        $this->getSnapRedirect($checkout);

        //Sending Email
        Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));

        return redirect(route('checkout.success'));
        /*return $camp;
        return $request->all();*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    public function success()
    {
        return view('checkout.success');
    }

   /* public function invoice(Checkout $checkout)
    {
        return $checkout;
    }*/

    //MIDTRANS - HANDLER
    public function getSnapRedirect(Checkout $checkout)
    {
        $orderId = $checkout->id.'-'.Str::random(5);
        $price =  $checkout->Camp->price * 1000;
        $checkout->midtrans_booking_code = $orderId;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price
        ];

        $item_details = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Payment For {$checkout->Camp->title} Camp"
        ];

        $userData = [
            "first_name" => $checkout->User->name,
            "last_name" => "",
            "address" => $checkout->User->address,
            "city" => "",
            "postal_code" => "",
            "phone" => $checkout->User->phone,
            "country_code" => "IDN",
        ];

        $customer_details = [
            "first_name" => $checkout->User->first_name,
            "last_name" => "",
            "email" => $checkout->User->email,
            "phone" => $checout->User->phone,
            "billing_address" => $userData,
            "shipping_address" => $userData,
        ];


        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details, 
        ];

        try {
            //GET SNAP PAYMENT PAGE URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();

            return $paymentUrl;
        } catch (Exception $e) {
            return false;
        }
    }

    public function midtransCallback(Request $request)
    {
        $notif = new Midtrans\Notification();

        $transaction_status = $notif->transliterator_status;
        $fraud = $notif->fraud_status;

        $checkout_id = explode('-', $notif->order_id)[0];
        $checkout = Checkout::find($checkout_id);

        if($transaction_status == 'capture') 
        {
            if ($fraud == 'challenge') {
                $checkout->payment_status = 'pending';

            } else if ($fraud == 'accept') {
                $checkout->payment_status = 'paid';
            }

        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {

                $checkout->payment_status = 'failed';

            } else if ($fraud == 'accept') {

                $checkout->payment_status = 'failed';
            }

        } else if ($transaction_status == 'deny') {

            $checkout->payment_status = 'paid';

        } else if ($transaction_status == 'settlement') {

            $checkout->payment_status = 'paid';

        } else if ($transaction_status == 'pending') {

            $checkout->payment_status = 'pending';

        } else if ($transaction_status == 'expired') {

            $checkout->payment_status = 'failed';

        }
        $checkout->save();
        return view('checkout/success');
    }
}
