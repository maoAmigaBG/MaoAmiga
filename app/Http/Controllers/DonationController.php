<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members_donation;
use App\Http\Controllers\Controller;
use Stripe;

class DonationController extends Controller {
    public function store(Request $request) {
        Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $payment_intent = Stripe\PaymentIntent::create([
            'amount' => 1099, // amount in cents (R$10.99)
            'currency' => 'brl',
            'payment_method_types' => ['pix'],
        ]);
        Members_donation::create([
            'stripe_payment_intent_id' => $payment_intent->id, // just for clarification, thats the "stripe_payment_intent_id"
            'doacao' => $payment_intent->amount,
            'moeda' => $payment_intent->currency,
            'status' => 'pending',
        ]);
        return response()->json([
            'client_secret' => $payment_intent->client_secret,
            'stripe_payment_intent_id' => $payment_intent->id
        ]);
    }
    public function status($stripe_payment_intent_id) {
        // i think in use this because of user ux, so i mean
        // creating a interval that calls this function every few seconds (like 2 or something),
        // so you see and return a proper response for the succeeded payment to the user
        $payment = Members_donation::where("stripe_payment_intent_id", $stripe_payment_intent_id)->first();
        if (empty($payment)) {
            return response()->json(["status" => "not_found"], 404);
        }
        return response()->json(["status" => $payment->status]);// can be pending, succeeded or failed
    }
}
