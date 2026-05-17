<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if ($hashed !== $request->signature_key) {
            return abort(403);
        }

        // Extract ID from format ORD-{id}-{timestamp}
        $orderIdParts = explode('-', $request->order_id);
        $orderId = $orderIdParts[1];

        $order = Order::findOrFail($orderId);

        $transactionStatus = $request->transaction_status;
        $fraudStatus = $request->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->update(['status' => 'pending']);
            } else {
                if ($order->status !== 'paid') {
                    $order->update(['status' => 'paid']);
                    foreach ($order->items as $item) {
                        $product = \App\Models\Product::find($item->product_id);
                        if ($product) {
                            $product->decrement('stock', $item->quantity);
                        }
                    }
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            if ($order->status !== 'paid') {
                $order->update(['status' => 'paid']);
                foreach ($order->items as $item) {
                    $product = \App\Models\Product::find($item->product_id);
                    if ($product) {
                        $product->decrement('stock', $item->quantity);
                    }
                }
            }
        } elseif ($transactionStatus == 'deny') {
            $order->update(['status' => 'failed']);
        } elseif ($transactionStatus == 'expire') {
            $order->update(['status' => 'expired']);
        } elseif ($transactionStatus == 'cancel') {
            $order->update(['status' => 'cancelled']);
        }

        return response()->json(['message' => 'Notification processed successfully']);
    }
}
