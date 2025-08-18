<?php

namespace App\Http\Controllers;

use App\Models\Members_donation;
use Stripe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Stripe\Exception\SignatureVerificationException;

class WebhookController extends Controller {
    public function handleWebhook(Request $request): Response {
        $signature = $request->header('Stripe-Signature');
        $secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Stripe\Webhook::constructEvent(
                $request->getContent(), $signature, $secret
            );
        } catch (SignatureVerificationException $e) {
            return response('Invalid signature.', 400);
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload.', 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $payment_intent = $event->data->object;
                $payment = Members_donation::where('stripe_payment_intent_id', $payment_intent->id)->first();
                if ($payment && $payment->status === 'pending') {
                    $payment->status = 'succeeded';
                    $payment->save();
                }
                break;
            
            case 'payment_intent.payment_failed':
                $payment_intent = $event->data->object;
                $payment = Members_donation::where('stripe_payment_intent_id', $payment_intent->id)->first();
                if ($payment) {
                    $payment->status = 'failed';
                    $payment->save();
                }
                break;
        }

        return response('Webhook Handled', 200);
    }
}
