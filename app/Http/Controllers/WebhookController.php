<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Midtrans\Notification;


class WebhookController extends Controller
{
    public function midtransCallback(Request $request)
    {
        $notif = new Notification();

        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;
        $payment_type = $notif->payment_type;
        $fraud = $notif->fraud_status;

        $payment = Payment::where('midtrans_order_id', $order_id)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if ($transaction == 'capture') {
            if ($payment_type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $payment->payment_status = 'unpaid';
                } else {
                    $payment->payment_status = 'paid';
                }
            }
        } else if ($transaction == 'settlement') {
            $payment->payment_status = 'paid';
        } else if (in_array($transaction, ['deny', 'cancel', 'expire'])) {
            $payment->payment_status = 'unpaid';
        } else if ($transaction == 'pending') {
            $payment->payment_status = 'unpaid';
        }

        $payment->save();

        // Update status booking juga
        if ($payment->payment_status === 'paid') {
            $booking = Booking::where('id', $payment->booking_id)->first();
            $booking->update(['payment_status' => 'paid', 'status' => 'confirmed']);
            // Send notification to worker
        }

        return response()->json(['message' => 'Payment status updated']);
    }
}

