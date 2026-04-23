<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | ITB.SpeedShop</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #333; }
    </style>
</head>
<body class="bg-white">

    <x-navbar-guest />

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-8">
            <a href="/" class="hover:text-red-600">HOME</a> <span class="mx-2">/</span> 
            <a href="#" class="hover:text-red-600">CATEGORIES</a> <span class="mx-2">/</span> 
            <a href="#" class="hover:text-red-600">{{ $product->category }}</a> <span class="mx-2">/</span> 
            <span class="text-gray-900">{{ $product->name }}</span>
        </div>

        <div class="grid md:grid-cols-2 gap-12 lg:gap-16 items-start">
            
            <div class="relative bg-gray-50 aspect-square overflow-hidden border border-gray-200 flex items-center justify-center p-4">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-contain" alt="{{ $product->name }}">
                @else
                    <div class="text-gray-400 font-bold uppercase text-xs tracking-widest italic">No Image</div>
                @endif
                <button class="absolute bottom-4 left-4 bg-white p-2 rounded-full shadow-md text-gray-500 hover:text-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                </button>
            </div>

            <div class="flex flex-col">
                <h1 class="text-3xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $product->name }}
                </h1>
                
                <p class="text-2xl font-bold text-red-600 mb-6">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>

                <div class="mb-6">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Sistem Pemesanan :</h3>
                    <ul class="list-disc pl-5 text-[11px] text-gray-500 space-y-2 leading-relaxed">
                        <li>Wajib menanyakan stok terlebih dahulu kepada admin sebelum melakukan pemesanan.</li>
                        <li>Pemesanan bisa dilakukan setiap hari Senin-Minggu.</li>
                        <li>Proses pemesanan dilakukan setiap hari Senin-Sabtu.</li>
                        <li>Untuk pemesanan hari Minggu, diproses keesokan harinya (hari Senin).</li>
                        <li>Mohon cantumkan pilihan warna atau tipe pada catatan pembeli ketika melakukan pesanan.</li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h3 class="text-xs font-bold text-gray-900 mb-1">Berat</h3>
                    <p class="text-[12px] text-gray-500">1 kg</p>
                </div>

                <div class="mb-6">
                    @if($product->stock > 0)
                        <span class="text-sm font-bold text-green-600">In stock ({{ $product->stock }})</span>
                    @else
                        <span class="text-sm font-bold text-red-600">Stok habis</span>
                    @endif
                </div>

                <div class="flex items-center justify-between text-[11px] font-bold text-gray-600 mb-8 border-b border-gray-200 pb-8">
                    <div>
                        <span class="mr-4">SKU: <span class="font-normal text-gray-500">ITB-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span></span>
                        <span>Kategori: <span class="font-normal text-gray-500 uppercase">{{ $product->category }}</span></span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>Share:</span>
                        <span class="cursor-pointer hover:text-red-600 font-normal">F</span>
                        <span class="cursor-pointer hover:text-red-600 font-normal">X</span>
                        <span class="cursor-pointer hover:text-red-600 font-normal">WA</span>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex space-x-8 border-b border-gray-200 mb-6">
                        <button class="text-[12px] font-bold text-gray-900 uppercase tracking-widest border-b-2 border-red-600 pb-3">Deskripsi</button>
                        <button class="text-[12px] font-bold text-gray-400 uppercase tracking-widest hover:text-gray-900 pb-3">Shipping & Delivery</button>
                    </div>
                    <div class="text-[12px] text-gray-500 leading-loose whitespace-pre-line">
                        {{ $product->description ?? 'Deskripsi lengkap produk belum ditambahkan oleh Admin.' }}
                    </div>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-full font-bold uppercase text-[12px] tracking-widest hover:bg-black transition shadow-lg shadow-red-200">
                        Tambah Ke Keranjang
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-24">
            <h2 class="text-xl font-bold text-gray-900 mb-8">Produk Lainnya</h2>
            
            @php
                // Ambil 4 produk lain secara acak dari database untuk rekomendasi
                $related_products = \App\Models\Product::where('id', '!=', $product->id)->take(4)->get();
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($related_products as $related)
                <div class="border border-gray-100 rounded-lg p-4 hover:shadow-lg transition bg-white flex flex-col group cursor-pointer" onclick="window.location.href='{{ route('product.show', $related->slug) }}'">
                    <div class="aspect-square bg-gray-50 mb-4 flex items-center justify-center p-2">
                        @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" class="max-w-full max-h-full object-contain group-hover:scale-105 transition">
                        @else
                            <span class="text-[10px] text-gray-300">NO IMG</span>
                        @endif
                    </div>
                    <h3 class="text-[12px] font-bold text-gray-900 mb-2 truncate">{{ $related->name }}</h3>
                    <div class="flex items-center text-green-600 text-[10px] font-bold mb-2">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        In stock
                    </div>
                    <p class="text-sm font-bold text-red-600 mt-auto">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
        </div>

    </main>

    <x-footer-guest />

</body>
</html>