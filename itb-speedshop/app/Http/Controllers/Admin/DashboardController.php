<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function index(Request $request)
    {
        // Fetch products for inventory management
        $products = Product::latest()->paginate(10, ['*'], 'products_page');

        // Fetch orders for transaction tracking
        $orders = Order::with(['user', 'items.product'])->latest()->paginate(10, ['*'], 'orders_page');

        return view('admin.dashboard', compact('products', 'orders'));
    }

    /**
     * Update the status of an order.
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,expired,cancelled,shipped,completed',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui!');
    }
}
