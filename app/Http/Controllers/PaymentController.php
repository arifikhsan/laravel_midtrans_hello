<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function pay(PaymentRequest $request)
    {
        // Set your Merchant Server Key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        // dd(intval($request->input('amount')));

        // Uncomment for append and override notification URL
        // Config::$appendNotifUrl = "https://example.com";
        // Config::$overrideNotifUrl = "https://example.com";

        // Required
        $transaction_details = [
            'order_id' => rand(),
            'gross_amount' => intval($request->input('amount')), // no decimal allowed for creditcard
        ];

        // Optional
        $item1_details = [
            'id' => 'a1',
            'price' => 18000,
            'quantity' => 3,
            'name' => "Apple"
        ];

        // Optional
        $item2_details = [
            'id' => 'a2',
            'price' => 20000,
            'quantity' => 2,
            'name' => "Orange"
        ];

        // Optional
        $item_details = [$item1_details, $item2_details];

        // Optional
        $billing_address = [
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'address'       => "Mangga 20",
            'city'          => "Jakarta",
            'postal_code'   => "16602",
            'phone'         => "081122334455",
            'country_code'  => 'IDN'
        ];

        // Optional
        $shipping_address = [
            'first_name'    => "Obet",
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        ];

        // Optional
        $customer_details = [
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'email'         => "andri@litani.com",
            'phone'         => "081122334455",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        ];

        // Optional, remove this to display all available payment methods
        // $enable_payments = ['credit_card', 'cimb_clicks', 'mandiri_clickpay', 'echannel'];

        // Fill transaction details
        $transaction = [
            // 'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        $snapToken = Snap::getSnapToken($transaction);
        // dd($snapToken);
        return view('payment', ['snapToken' => $snapToken]);
    }

    public function handle(Request $request)
    {
        dd($request);
        return $request;
    }

    public function finish(Request $request)
    {
        $body = $request->getContent();
        return view('finish', ['id' => $request->query('id'), 'body' => $body,]);
    }

    public function error()
    {
        return 'error';
    }
}
