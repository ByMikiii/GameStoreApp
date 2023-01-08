<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Session;
use Auth;

class StripePaymentController extends Controller
{
     public function getSession(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $checkout = $stripe->checkout->sessions->create([
                'success_url' => 'http://localhost:3000/success',
                'cancel_url' => 'http://localhost:3000/cancel',
                'line_items' => [
                    [
                    'price_data' => [
                        'currency' => 'USD',
                        'unit_amount' => 5000,
                        'product_data' => [
                            'name' => 'ITEM NAME NEHGEE' ,
                        ],
                    ],
                    'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
        ]);

        return $checkout;
    }

    public function webhook(Request $request){
        \Log::info("webhook");

        $endpoint_secret = env('STRIPE_END_SECRET');
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            http_response_code(400);
            exit();
        }

        if($request->type == 'checkout.session.completed'){
            //ADD CREDIT TO THE USER
            \Log::info("DONE");
        }
        

        return response()->json(["status" => "success"]);
    }
}