<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITB.SpeedShop | Premium Performance</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Google Model Viewer untuk 3D Model -->
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js"></script>
    
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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

    <header class="relative pt-24 pb-0 bg-[#F2F0F1] overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 items-center gap-12 relative">
            <div data-aos="fade-up" data-aos-duration="1000" class="z-10 pb-8 md:pb-10 pt-10">
                <h1 class="text-[3.5rem] md:text-[5rem] lg:text-[5.5rem] font-black text-red-600 leading-[1] mb-6 uppercase tracking-tighter" style="font-family: 'Arial Black', Impact, sans-serif;">
                    Temukan 
                    <span class="text-black">Part</span>
                    <span class="text-red-600">Impianmu</span>
                    <span class="text-black">disini</span>
                </h1>
                <p class="text-gray-600 text-sm md:text-base mb-10 max-w-md leading-relaxed">
                    Telusuri beragam pilihan suku cadang sepeda motor kami yang dibuat dengan cermat, dirancang untuk memaksimalkan performa motor Anda dan memenuhi selera gaya Anda.
                </p>
                <a href="#katalog" class="inline-flex items-center justify-center bg-red-600 text-white px-12 py-4 rounded-full font-medium hover:bg-red-800 transition-all duration-300 shadow-xl mb-12">
                    Belanja Sekarang
                </a>
                
                <!-- Stats -->
                <div class="flex flex-wrap items-center gap-6 md:gap-12 mt-4">
                    <div>
                        <h3 class="text-3xl md:text-4xl font-bold text-red-600 mb-1">200+</h3>
                        <p class="text-gray-500 text-xs md:text-sm">International Brands</p>
                    </div>
                    <div class="w-px h-12 bg-gray-300 hidden md:block"></div>
                    <div>
                        <h3 class="text-3xl md:text-4xl font-bold text-red-600 mb-1">1000+</h3>
                        <p class="text-gray-500 text-xs md:text-sm">High-Quality Products</p>
                    </div>
                    <div class="w-px h-12 bg-gray-300 hidden md:block"></div>
                    <div>
                        <h3 class="text-3xl md:text-4xl font-bold text-red-600 mb-1">500+</h3>
                        <p class="text-gray-500 text-xs md:text-sm">Happy Customers</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: 3D Model -->
            <div class="relative w-full h-[350px] md:h-[500px] flex justify-center items-center" data-aos="zoom-in" data-aos-delay="200">
                <!-- Sparkle decorations -->
                <svg class="absolute top-10 right-10 w-12 h-12 text-red-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z"/></svg>
                <svg class="absolute bottom-40 left-0 w-8 h-8 text-red-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z"/></svg>

                <!-- 
                  Catatan: Anda perlu mengunduh model 3D Ducati Panigale V4 (format .glb) 
                  dan menyimpannya di folder: public/models/ducati_panigale_v4.glb
                -->
                <model-viewer 
                    class="w-full h-full outline-none"
                    src="{{ asset('models/ducati_panigale_v4.glb') }}" 
                    alt="3D Ducati Panigale V4" 
                    auto-rotate 
                    rotation-per-second="30deg"
                    camera-controls 
                    shadow-intensity="1" 
                    environment-image="neutral"
                    exposure="1.0"
                    disable-zoom>
                </model-viewer>
            </div>
        </div>
    </header>

    <main id="katalog" class="max-w-7xl mx-auto px-6 pt-12 pb-24">
        <div class="flex items-end justify-between mb-16" data-aos="fade-up">
            <div>
                <h2 class="text-4xl md:text-5xl lg:text-[2.5rem] font-black text-black tracking-tighter uppercase" style="font-family: 'Arial Black', Impact, sans-serif;">New Arrivals</h2>
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
                    
                    <a href="{{ route('product.show', $product->slug) }}" class="mt-auto w-full bg-red-600 text-white py-4 rounded-2xl font-bold hover:bg-red-900 transition-all duration-300 flex items-center justify-center group uppercase text-[10px] tracking-widest shadow-lg shadow-gray-200">
                        <span>Lihat Detail</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <!-- Brands Logo Section -->
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-10" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-black text-black uppercase tracking-tighter" style="font-family: 'Arial Black', Impact, sans-serif;">
                Our Partners
            </h2>
            <div class="h-1.5 w-20 bg-red-600 mt-4"></div>
        </div>
        <div class="flex justify-center items-center" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset('images/foto brand.webp') }}" alt="Our Partners" class="w-full h-auto object-contain">
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="max-w-7xl mx-auto px-6 py-24 overflow-hidden">
        <div class="flex items-center justify-between mb-12" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl lg:text-[2.5rem] font-black text-black tracking-tighter uppercase" style="font-family: 'Arial Black', Impact, sans-serif;">
                Our Happy Customers
                <div class="h-1.5 w-20 bg-red-600 mt-4"></div>
            </h2>
            <div class="hidden md:flex space-x-4 text-3xl font-bold text-black">
                <button class="hover:text-red-600 transition-colors" onclick="document.getElementById('testimonial-container').scrollBy({left: -400, behavior: 'smooth'})">←</button>
                <button class="hover:text-red-600 transition-colors" onclick="document.getElementById('testimonial-container').scrollBy({left: 400, behavior: 'smooth'})">→</button>
            </div>
        </div>

        <!-- Scrollable / Grid container -->
        <div id="testimonial-container" class="flex overflow-x-auto pb-8 -mx-6 px-6 space-x-6 snap-x snap-mandatory hide-scrollbar" data-aos="fade-up" data-aos-delay="200">
            <!-- Card 1 -->
            <div class="flex-none w-[350px] md:w-[400px] border border-gray-200 rounded-[2rem] p-8 snap-start hover:shadow-xl transition-shadow bg-white">
                <div class="text-yellow-400 text-2xl mb-4 tracking-widest">★★★★★</div>
                <div class="flex items-center mb-4">
                    <span class="font-bold text-xl text-black">Budi S.</span>
                    <svg class="w-6 h-6 ml-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <p class="text-gray-500 leading-relaxed text-base">"Barang ori dan kualitasnya tidak perlu diragukan lagi. Tarikan motor jadi lebih enteng setelah ganti part dari sini. Sangat memuaskan dan pelayanannya top!"</p>
            </div>
            <!-- Card 2 -->
            <div class="flex-none w-[350px] md:w-[400px] border border-gray-200 rounded-[2rem] p-8 snap-start hover:shadow-xl transition-shadow bg-white">
                <div class="text-yellow-400 text-2xl mb-4 tracking-widest">★★★★★</div>
                <div class="flex items-center mb-4">
                    <span class="font-bold text-xl text-black">Alex K.</span>
                    <svg class="w-6 h-6 ml-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <p class="text-gray-500 leading-relaxed text-base">"Pelayanan sangat ramah dan pengiriman super cepat. Saya mencari part spesifik untuk motor saya dan langsung ketemu di ITB.SpeedShop dengan mudah."</p>
            </div>
            <!-- Card 3 -->
            <div class="flex-none w-[350px] md:w-[400px] border border-gray-200 rounded-[2rem] p-8 snap-start hover:shadow-xl transition-shadow bg-white">
                <div class="text-yellow-400 text-2xl mb-4 tracking-widest">★★★★★</div>
                <div class="flex items-center mb-4">
                    <span class="font-bold text-xl text-black">Dimas W.</span>
                    <svg class="w-6 h-6 ml-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <p class="text-gray-500 leading-relaxed text-base">"Harga kompetitif dibandingkan bengkel sebelah, tapi kualitas tetap juara. Mekaniknya juga ngasih saran yang bagus buat modifikasi motor kesayangan."</p>
            </div>
            <!-- Card 4 -->
            <div class="flex-none w-[350px] md:w-[400px] border border-gray-200 rounded-[2rem] p-8 snap-start hover:shadow-xl transition-shadow bg-white">
                <div class="text-yellow-400 text-2xl mb-4 tracking-widest">★★★★★</div>
                <div class="flex items-center mb-4">
                    <span class="font-bold text-xl text-black">Reza P.</span>
                    <svg class="w-6 h-6 ml-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <p class="text-gray-500 leading-relaxed text-base">"Mantap! Baru pertama kali beli di sini langsung puas. Packing aman dan barang sesuai dengan deskripsi. Auto jadi langganan pokoknya kalau butuh part."</p>
            </div>
            <!-- Card 5 -->
            <div class="flex-none w-[350px] md:w-[400px] border border-gray-200 rounded-[2rem] p-8 snap-start hover:shadow-xl transition-shadow bg-white">
                <div class="text-yellow-400 text-2xl mb-4 tracking-widest">★★★★★</div>
                <div class="flex items-center mb-4">
                    <span class="font-bold text-xl text-black">Sarah M.</span>
                    <svg class="w-6 h-6 ml-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <p class="text-gray-500 leading-relaxed text-base">"Sebagai orang awam soal motor, saya sangat terbantu dengan rekomendasi dari tim. Ganti shockbreaker baru, motor jadi terasa jauh lebih nyaman dipakai harian."</p>
            </div>
        </div>
    </section>

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