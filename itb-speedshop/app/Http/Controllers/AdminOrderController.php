<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan dengan data user dan item
        $orders = Order::with(['user', 'items'])->latest()->get();
        
        // Hitung total produk terjual
        $totalSold = 0;
        foreach ($orders as $order) {
            if (in_array($order->status, ['paid', 'diproses', 'dikirim', 'selesai'])) {
                foreach ($order->items as $item) {
                    $totalSold += $item->quantity;
                }
            }
        }

        return view('admin.orders.index', compact('orders', 'totalSold'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,diproses,dikirim,selesai,failed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
