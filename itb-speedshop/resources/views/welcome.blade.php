<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITB.SpeedShop | Premium Performance</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .nav-blur { backdrop-filter: blur(12px); background-color: rgba(255, 255, 255, 0.8); }
        .product-card { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .product-card:hover { transform: translateY(-12px); }
        .img-zoom { transition: transform 0.6s shadow 0.6s ease; }
        .product-card:hover .img-zoom { transform: scale(1.1); }
    </style>
</head>
<body class="bg-white text-gray-900 overflow-x-hidden">

    <x-navbar-guest />

    <header class="relative pt-32 pb-20 md:pt-48 md:pb-32 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 items-center gap-12">
            <div data-aos="fade-up" data-aos-duration="1000">
                <span class="inline-block px-4 py-1.5 bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6">Original Racing Parts</span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-[1.1] mb-8 uppercase italic">
                    Power <br> <span class="text-red-600">Redefined.</span>
                </h1>
                <p class="text-gray-500 text-lg mb-10 max-w-md leading-relaxed">Tingkatkan performa berkendara Anda dengan pilihan sparepart mesin dan variasi original hanya di ITB.SpeedShop.</p>
                <div class="flex space-x-4">
                    <a href="#katalog" class="inline-flex items-center justify-center bg-gray-900 text-white px-10 py-4 rounded-full font-bold shadow-2xl hover:bg-red-600 transition-all duration-300 transform hover:scale-105 uppercase text-xs tracking-widest">Shop Now</a>
                    <a href="#" class="flex items-center space-x-3 px-6 py-4 font-bold text-gray-700 hover:text-red-600 transition group text-xs tracking-widest">
                        <span>See Video</span>
                        <div class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition">▶</div>
                    </a>
                </div>
            </div>
            <div class="relative" data-aos="zoom-in" data-aos-delay="200">
                <div class="absolute inset-0 bg-red-600 rounded-full blur-[120px] opacity-10"></div>
                <img src="{{ asset('images/hero banner.png') }}" class="relative z-10 rounded-3xl shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-700" alt="Hero Banner">
            </div>
        </div>
    </header>

    <main id="katalog" class="max-w-7xl mx-auto px-6 py-24">
        <div class="flex items-end justify-between mb-16" data-aos="fade-up">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 uppercase italic tracking-tighter">New Arrivals</h2>
                <div class="h-1.5 w-20 bg-red-600 mt-2"></div>
            </div>
            <a href="{{ route('categories') }}" class="text-[10px] font-black text-red-600 hover:underline tracking-[0.2em] uppercase">View All Collection</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="product-card bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-50 flex flex-col" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="relative h-72 overflow-hidden bg-gray-50">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-zoom w-full h-full object-cover" alt="{{ $product->name }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300 font-bold uppercase text-[9px] tracking-[0.3em] italic">No Image Provided</div>
                    @endif
                    <div class="absolute top-5 left-5 bg-white/90 backdrop-blur px-4 py-1.5 rounded-full text-[9px] font-black text-red-600 uppercase shadow-sm">
                        {{ $product->category }}
                    </div>
                </div>

                <div class="p-8 flex flex-col flex-grow text-center">
                    <h3 class="font-bold text-lg mb-3 text-gray-900 leading-tight h-14 overflow-hidden italic">{{ $product->name }}</h3>
                    <p class="text-red-600 font-black text-2xl mb-8 tracking-tighter">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    
                    <a href="{{ route('product.show', $product->slug) }}" class="mt-auto w-full bg-gray-900 text-white py-4 rounded-2xl font-bold hover:bg-red-600 transition-all duration-300 flex items-center justify-center group uppercase text-[10px] tracking-widest shadow-lg shadow-gray-200">
                        <span>Lihat Detail</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <x-footer-guest />

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1000,
            offset: 150,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>