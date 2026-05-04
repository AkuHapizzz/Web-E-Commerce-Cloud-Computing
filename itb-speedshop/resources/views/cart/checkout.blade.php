<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ITB.SpeedShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden">

    <x-navbar-guest />

    <!-- Progress Bar -->
    <div class="bg-black text-white py-6">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="font-black text-xl md:text-2xl tracking-tighter italic">
                <a href="{{ route('cart.index') }}" class="text-white hover:text-gray-300 transition">Shopping Cart</a> 
                <span class="text-gray-600 mx-3">&rarr;</span> 
                <span class="text-white border-b-2 border-red-600 pb-1">Checkout</span> 
                <span class="text-gray-600 mx-3">&rarr;</span> 
                <span class="text-gray-600">Order Complete</span>
            </h2>
        </div>
    </div>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <form action="{{ route('checkout.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                @csrf
                <!-- Billing Details -->
                <div class="lg:col-span-2">
                    <div class="p-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Nama</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition" required>
                            </div>
                            
                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition" required>
                            </div>

                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Negara</label>
                                <input type="text" name="country" value="Indonesia" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition">
                            </div>

                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Provinsi</label>
                                <input type="text" name="state" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition" required>
                            </div>

                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Kota / Kabupaten</label>
                                <input type="text" name="city" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition" required>
                            </div>

                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Kecamatan</label>
                                <input type="text" name="district" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition" required>
                            </div>

                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Alamat Jalan</label>
                                <input type="text" name="address" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition" required>
                            </div>

                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Kode Pos</label>
                                <input type="text" name="postal_code" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition" required>
                            </div>

                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Nomor Telepon</label>
                                <input type="text" name="phone" placeholder="+62xxx - xxxx - xxxx" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition" required>
                            </div>

                            <div>
                                <label class="block font-bold text-gray-900 mb-2">Catatan Pesanan</label>
                                <input type="text" name="notes" placeholder="Masukkan Catatan" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-red-600 transition">
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="p-8 sticky top-24">
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-8 tracking-tighter">Orderanmu</h3>
                        
                        <div class="space-y-6 text-sm font-bold mb-10">
                            <div class="flex justify-between items-center text-gray-900">
                                <span class="text-lg font-extrabold">Subtotal</span>
                                <span class="text-right">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-900 border-t border-gray-200 pt-6">
                                <span class="text-lg font-extrabold">Shipment</span>
                                <select name="shipment_type" class="text-xs font-bold border border-gray-300 rounded-md px-2 py-1 focus:outline-none focus:border-red-600">
                                    <option value="ambil_di_toko">Ambil di Toko</option>
                                    <option value="kirim_ke_rumah">Kirim ke Rumah</option>
                                </select>
                            </div>
                            <div class="flex justify-between items-center text-gray-900 border-t border-gray-200 pt-6">
                                <span class="text-lg font-extrabold">Total</span>
                                <span class="text-right">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex space-x-4 mb-6">
                            <input type="text" placeholder="Masukkan Kupon" class="w-full border-2 border-gray-300 rounded-full px-6 py-3 text-sm focus:outline-none focus:border-red-600 transition">
                            <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full font-bold text-xs uppercase tracking-widest whitespace-nowrap transition">Terapkan Kupon</button>
                        </div>

                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white text-center py-4 rounded-full font-bold text-sm transition">
                            Lanjutkan Checkout
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-footer-guest />
</body>
</html>
