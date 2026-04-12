<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | ITB.SpeedShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #333; }
        /* Menyembunyikan scrollbar tapi tetap bisa di-scroll secara horizontal */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-white">

    <x-navbar-guest />

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
            <h1 class="text-sm font-black uppercase tracking-widest text-gray-900">CATEGORIES</h1>
            <span class="text-[11px] text-gray-500">
                Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} hasil
            </span>
        </div>

        @php
            $categoriesList = [
                'Shock Depan', 'Shock Belakang', 'Velg', 'Ban', 'Piringan', 'Kaliper Rem', 
                'Master Rem', 'Selang Rem', 'Knalpot', 'Part Part CVT', 'Filter Udara', 'Busi', 
                'Cover Radiator', 'Cover Knalpot', 'Hugger', 'Visor', 'Body Kasar', 'Karpet Dek', 
                'Emblem', 'Baut', 'Spion', 'Handgrip', 'Jalu Stang', 'Cover Jok'
            ];
            $currentCat = request('category');
        @endphp
        
        <div class="flex overflow-x-auto space-x-6 pb-8 mb-8 border-b border-gray-100 scrollbar-hide">
            
            <a href="{{ route('categories') }}" class="flex flex-col items-center min-w-[80px] cursor-pointer group hover:opacity-70 transition">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-3 border transition {{ empty($currentCat) ? 'bg-red-600 text-white border-red-600 shadow-md' : 'bg-red-50 text-red-600 border-red-200 group-hover:bg-red-600 group-hover:text-white' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-center uppercase leading-tight w-full break-words {{ empty($currentCat) ? 'text-red-600' : 'text-gray-700 group-hover:text-red-600' }}">SEMUA</span>
            </a>

            @foreach($categoriesList as $cat)
            <a href="{{ route('categories', ['category' => $cat]) }}" class="flex flex-col items-center min-w-[80px] cursor-pointer group hover:opacity-70 transition">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-3 border transition {{ $currentCat == $cat ? 'bg-white border-red-600 ring-2 ring-red-100 text-red-600' : 'bg-gray-50 border-gray-200 text-gray-400 group-hover:border-red-600 group-hover:text-red-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-center uppercase leading-tight w-full break-words {{ $currentCat == $cat ? 'text-red-600' : 'text-gray-700 group-hover:text-red-600' }}">{{ $cat }}</span>
            </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <div class="hidden lg:block lg:col-span-1">
                <h3 class="text-xs font-bold uppercase tracking-widest mb-6 border-b border-gray-100 pb-2">Produk Terlaris</h3>
                <div class="flex flex-col space-y-6">
                    @foreach($bestSellers as $best)
                    <div class="flex items-center space-x-4 group cursor-pointer" onclick="window.location.href='{{ route('product.show', $best->slug) }}'">
                        <div class="w-16 h-16 bg-gray-50 flex-shrink-0 border border-gray-100 p-1 rounded-md overflow-hidden">
                            @if($best->image)
                                <img src="{{ asset('storage/' . $best->image) }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[8px] text-gray-300 font-bold">NO IMG</div>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <h4 class="text-[11px] font-bold text-gray-800 leading-tight mb-1 group-hover:text-red-600 transition line-clamp-2">{{ $best->name }}</h4>
                            <span class="text-xs font-bold text-red-600">Rp {{ number_format($best->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-3">
                
                <div class="flex justify-between items-center mb-6 bg-gray-50 p-3 rounded-md border border-gray-100">
                    <h2 class="text-xl font-bold text-blue-900 flex items-center">
                        Shop 
                        @if($currentCat)
                            <span class="text-sm font-normal text-gray-500 ml-2">/ {{ $currentCat }}</span>
                        @endif
                    </h2>
                    <div class="flex items-center space-x-6 text-[11px] text-gray-500 font-medium">
                        <span class="hidden sm:inline">Show: <span class="text-gray-900 font-bold">12</span> / 24 / 36</span>
                        <select class="bg-transparent border-none text-[11px] font-bold text-gray-700 cursor-pointer focus:ring-0">
                            <option>Pengurutan standar</option>
                            <option>Harga terendah</option>
                            <option>Harga tertinggi</option>
                            <option>Terbaru</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 mb-12">
                    @forelse($products as $product)
                    <div class="bg-white border border-gray-200 p-4 flex flex-col group hover:shadow-xl transition duration-300 rounded-lg">
                        <div class="aspect-square bg-gray-50 mb-4 cursor-pointer flex justify-center items-center p-2 rounded-md overflow-hidden" onclick="window.location.href='{{ route('product.show', $product->slug) }}'">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500">
                            @else
                                <span class="text-[10px] text-gray-300 font-bold tracking-widest">NO IMG</span>
                            @endif
                        </div>
                        
                        <h3 class="text-[12px] font-bold text-gray-900 leading-snug mb-2 cursor-pointer hover:text-red-600 line-clamp-2" onclick="window.location.href='{{ route('product.show', $product->slug) }}'">
                            {{ $product->name }}
                        </h3>
                        
                        <div class="flex items-center text-[10px] font-bold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }} mb-2">
                            @if($product->stock > 0)
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                In stock
                            @else
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Out of stock
                            @endif
                        </div>
                        
                        <p class="text-sm font-black text-red-600 mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        
                        <button class="mt-auto w-full {{ $product->stock > 0 ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-gray-200 text-gray-500 cursor-not-allowed' }} text-[10px] font-bold uppercase tracking-widest py-3 rounded-full transition" {{ $product->stock > 0 ? '' : 'disabled' }}>
                            Tambah Ke Keranjang
                        </button>
                    </div>
                    @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-gray-500 font-bold text-sm uppercase tracking-widest">Kategori ini masih kosong</p>
                    </div>
                    @endforelse
                </div>

                <div class="flex justify-center mt-8">
                    @if ($products->hasPages())
                        <div class="flex space-x-2 text-[12px] font-bold">
                            @if (!$products->onFirstPage())
                                <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-red-600 border border-gray-200 rounded hover:border-red-600 transition">&lt;</a>
                            @endif

                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <span class="w-8 h-8 flex items-center justify-center bg-red-600 text-white rounded shadow-md">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center text-gray-700 hover:text-red-600 border border-gray-200 rounded hover:border-red-600 transition">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-red-600 border border-gray-200 rounded hover:border-red-600 transition">&gt;</a>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

    <x-footer-guest />

</body>
</html>