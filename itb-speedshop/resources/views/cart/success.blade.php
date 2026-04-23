<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - ITB.SpeedShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-white text-gray-900 overflow-x-hidden min-h-screen flex flex-col">

    <x-navbar-guest />

    <!-- Progress Bar -->
    <div class="bg-black text-white py-6">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="font-black text-xl md:text-2xl tracking-tighter italic">
                <a href="#" class="text-white hover:text-gray-300 transition">Shopping Cart</a> 
                <span class="text-gray-600 mx-3">&rarr;</span> 
                <a href="#" class="text-white hover:text-gray-300 transition">Checkout</a> 
                <span class="text-gray-600 mx-3">&rarr;</span> 
                <span class="text-white border-b-2 border-red-600 pb-1">Order Complete</span>
            </h2>
        </div>
    </div>

    <div class="py-24 bg-white flex-grow flex items-center justify-center">
        <div class="max-w-2xl w-full text-center">
            
            <h1 class="text-3xl font-extrabold text-gray-900 mb-12 tracking-tighter">Pesanan Berhasil</h1>
            
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-400 tracking-tight">Pesananmu akan segera di proses,<br>please wait</h2>
            </div>

            <div class="max-w-md mx-auto space-y-4 text-sm font-bold mb-16 text-left">
                <div class="flex justify-between text-gray-900">
                    <span class="text-lg font-extrabold">Subtotal</span>
                    <span class="text-right">
                        Rp. {{ number_format($order->total_price, 0, ',', '.') }}<br>
                        Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </div>
                <div class="flex justify-between text-gray-900 pt-6">
                    <span class="text-lg font-extrabold">Shipment</span>
                    <span class="text-right text-sm">Kirim Ke alamat</span>
                </div>
                <div class="flex justify-between text-gray-900 pt-6 border-t border-gray-100">
                    <span class="text-lg font-extrabold">Total</span>
                    <span class="text-right">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="flex justify-center space-x-4">
                <a href="{{ url('/#katalog') }}" class="bg-red-600 hover:bg-black text-white px-8 py-3 rounded-full font-bold text-sm transition">
                    Lanjutkan Checkout
                </a>
                <a href="{{ route('dashboard') }}" class="bg-red-600 hover:bg-black text-white px-8 py-3 rounded-full font-bold text-sm transition">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</body>
</html>
