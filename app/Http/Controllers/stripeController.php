<?php

namespace App\Http\Controllers;

use Stripe\StripeClient;
use Illuminate\Http\Request;

class stripeController extends Controller
{
    public $stripe;
    public function __construct(){
         $this->stripe = new StripeClient(
                config("stripe.api_key")
         );
    }

    public function pay(){
        $session = $this->stripe->checkout->sessions->create(
            
$checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => [[
                'price' => '{{PRICE_ID}}',
                "price_data"=>[

                    "product_data"=>[
                        "name"=>"invoice"
                    ],
                ],
                'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://example.com/success',
                'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
            ])
        );
        return redirect($session->url);
    }
}
