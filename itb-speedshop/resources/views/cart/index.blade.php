<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - ITB.SpeedShop</title>
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
                <span class="text-white border-b-2 border-red-600 pb-1">Shopping Cart</span> 
                <span class="text-gray-600 mx-3">&rarr;</span> 
                <span class="text-gray-600">Checkout</span> 
                <span class="text-gray-600 mx-3">&rarr;</span> 
                <span class="text-gray-600">Order Complete</span>
            </h2>
        </div>
    </div>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8">
                        @if(empty($cart))
                            <p class="text-center text-gray-500 font-bold py-12">Keranjang belanjamu kosong.</p>
                            <div class="text-center pb-8">
                                <a href="{{ url('/#katalog') }}" class="bg-red-600 text-white px-8 py-4 rounded-full font-bold hover:bg-black transition uppercase text-xs tracking-widest">Mulai Belanja</a>
                            </div>
                        @else
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b-2 border-gray-100">
                                        <th class="pb-4 uppercase text-xs font-black tracking-widest text-gray-900 w-12">No.</th>
                                        <th class="pb-4 uppercase text-xs font-black tracking-widest text-gray-900">Produk</th>
                                        <th class="pb-4 text-center uppercase text-xs font-black tracking-widest text-gray-900">Harga</th>
                                        <th class="pb-4 text-center uppercase text-xs font-black tracking-widest text-gray-900">Jumlah</th>
                                        <th class="pb-4 text-right uppercase text-xs font-black tracking-widest text-gray-900">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($cart as $id => $item)
                                    <tr class="border-b border-gray-100 last:border-b-0">
                                        <td class="py-6 text-sm text-gray-500 font-bold">{{ $no++ }}.</td>
                                        <td class="py-6 flex items-center space-x-6">
                                            @if($item['image'])
                                                <img src="{{ asset('storage/' . $item['image']) }}" class="w-24 h-24 object-cover bg-gray-50">
                                            @else
                                                <div class="w-24 h-24 bg-gray-100 flex items-center justify-center text-[8px] font-bold text-gray-400">NO IMG</div>
                                            @endif
                                            <div>
                                                <h4 class="font-bold text-gray-700 text-sm md:text-base leading-tight max-w-[200px]">{{ $item['name'] }}</h4>
                                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-2">
                                                    @csrf @method('DELETE')
                                                    <button class="text-[10px] text-red-500 font-bold hover:text-red-700 uppercase tracking-widest">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="py-6 text-center text-sm font-bold text-gray-700">
                                            Rp. {{ number_format($item['price'], 0, ',', '.') }}
                                        </td>
                                        <td class="py-6 text-center">
                                            <div class="inline-flex items-center bg-gray-200 p-0.5">
                                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="decrease">
                                                    <button class="w-8 h-8 flex items-center justify-center font-bold text-gray-600 hover:bg-gray-300 transition">-</button>
                                                </form>
                                                <span class="w-10 text-center font-bold text-sm text-gray-900 bg-white h-8 flex items-center justify-center">{{ $item['quantity'] }}</span>
                                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="increase">
                                                    <button class="w-8 h-8 flex items-center justify-center font-bold text-gray-600 hover:bg-gray-300 transition">+</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="py-6 text-right font-bold text-gray-700 text-sm">
                                            Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <!-- Order Summary -->
                @if(!empty($cart))
                <div class="lg:col-span-1">
                    <div class="p-8">
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-8 tracking-tighter">Total Keranjang Belanja</h3>
                        
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

                        <a href="{{ route('checkout') }}" class="block w-full bg-red-600 hover:bg-red-700 text-white text-center py-4 rounded-full font-bold text-sm transition">
                            Lanjutkan Checkout
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-footer-guest />
</body>
</html>
