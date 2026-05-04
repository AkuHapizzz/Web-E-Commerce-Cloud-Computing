<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop & Store Gallery | ITB.SpeedShop</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Modifikasi panah bawaan Swiper biar bulat dan abu-abu seperti desain */
        .swiper-button-next, .swiper-button-prev {
            color: #333 !important;
            background-color: #e5e7eb; /* bg-gray-200 */
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background-color: #dc2626 !important; /* bg-red-600 */
            color: #fff !important;
        }
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 20px !important;
            font-weight: 900 !important;
        }
        /* Mengatur agar gambar yang tidak di tengah agak gelap */
        .swiper-slide { opacity: 0.5; transition: opacity 0.3s; }
        .swiper-slide-active { opacity: 1; }
    </style>
</head>
<body class="bg-white">

    <x-navbar-guest />

    <main class="py-16 overflow-hidden">
        
        <section class="mb-24">
            <h1 class="text-4xl md:text-5xl font-[900] text-red-600 text-center uppercase tracking-tighter mb-10">OUR STORE GALLERY</h1>
            
            <div class="relative max-w-6xl mx-auto px-12 lg:px-24">
                <div class="swiper storeSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide w-[300px] md:w-[600px]">
                            <img src="{{ asset('images/toko 1.jpg.jpeg') }}" class="w-full h-[250px] md:h-[400px] object-cover rounded-2xl shadow-2xl">
                        </div>
                        <div class="swiper-slide w-[300px] md:w-[600px]">
                            <img src="{{ asset('images/toko 2.jpg.jpeg') }}" class="w-full h-[250px] md:h-[400px] object-cover rounded-2xl shadow-2xl">
                        </div>
                        <div class="swiper-slide w-[300px] md:w-[600px]">
                            <img src="{{ asset('images/toko 3.jpg.jpeg') }}" class="w-full h-[250px] md:h-[400px] object-cover rounded-2xl shadow-2xl">
                        </div>
                        </div>
                </div>
                <div class="swiper-button-prev store-prev"></div>
                <div class="swiper-button-next store-next"></div>
            </div>

            <div class="text-center mt-8">
                <h3 class="text-2xl font-[900] text-red-600 mb-2">Our Store</h3>
                <p class="text-lg md:text-xl font-medium text-gray-800 leading-relaxed">
                    1. Jl. Panjang Arteri Klp. Dua Raya No.08A<br>
                    2. Jl. Tegal Mulyorejo Baru No.105
                </p>
            </div>
        </section>


        <section class="mb-16">
            <h1 class="text-4xl md:text-5xl font-[900] text-red-600 text-center uppercase tracking-tighter mb-10">OUR WORKSHOP GALLERY</h1>
            
            <div class="relative max-w-6xl mx-auto px-12 lg:px-24">
                <div class="swiper workshopSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide w-[300px] md:w-[600px]">
                            <img src="{{ asset('images/Bengkel 1.jpg.jpeg') }}" class="w-full h-[250px] md:h-[400px] object-cover rounded-2xl shadow-2xl">
                        </div>
                        <div class="swiper-slide w-[300px] md:w-[600px]">
                            <img src="{{ asset('images/Bengkel 2.jpg.jpeg') }}" class="w-full h-[250px] md:h-[400px] object-cover rounded-2xl shadow-2xl">
                        </div>
                        <div class="swiper-slide w-[300px] md:w-[600px]">
                            <img src="{{ asset('images/Bengkel 3.jpg.jpeg') }}" class="w-full h-[250px] md:h-[400px] object-cover rounded-2xl shadow-2xl">
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev workshop-prev"></div>
                <div class="swiper-button-next workshop-next"></div>
            </div>

            <div class="text-center mt-8">
                <h3 class="text-2xl font-[900] text-red-600 mb-2">Our Workshop</h3>
                <p class="text-lg md:text-xl font-medium text-gray-800 leading-relaxed">
                    1. Jl. Panjang Arteri Klp. Dua Raya No.09A<br>
                    2. Jl. Tegal Mulyorejo Baru No.106
                </p>
            </div>
        </section>

    </main>

    <x-footer-guest />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Konfigurasi Umum untuk efek Coverflow
        const swiperConfig = {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            autoplay: {
                delay: 3000, // Otomatis geser setiap 3 detik
                disableOnInteraction: false, // Tetap auto-play meski habis diklik
            },
            coverflowEffect: {
                rotate: 0, // Tidak miring, tetap lurus
                stretch: -50, // Mengatur jarak tumpukan gambar
                depth: 250, // Efek mundur (3D)
                modifier: 1,
                slideShadows: true,
            },
        };

        // Inisialisasi Slider Store
        new Swiper(".storeSwiper", {
            ...swiperConfig,
            navigation: {
                nextEl: ".store-next",
                prevEl: ".store-prev",
            },
        });

        // Inisialisasi Slider Workshop
        new Swiper(".workshopSwiper", {
            ...swiperConfig,
            navigation: {
                nextEl: ".workshop-next",
                prevEl: ".workshop-prev",
            },
        });
    </script>
</body>
</html>