<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-black italic tracking-tighter text-gray-900">
                    ITB<span class="text-red-600">.SpeedShop</span>
                </a>
            </div>

            <div class="hidden md:flex space-x-10">
                <a href="{{ url('/') }}" class="text-[11px] font-bold text-gray-500 hover:text-red-600 uppercase tracking-widest transition">Home</a>
                <a href="{{ route('categories') }}" class="text-[11px] font-bold text-gray-500 hover:text-red-600 uppercase tracking-widest transition">Categories</a>
                <a href="{{ route('workshop') }}" class="text-[11px] font-bold text-gray-500 hover:text-red-600 uppercase tracking-widest transition">Workshop</a>
                <a href="{{ route('contact') }}" class="text-[11px] font-bold text-gray-500 hover:text-red-600 uppercase tracking-widest transition">Contact Us</a>
            </div>

            <div class="flex items-center space-x-6 text-gray-600">
                <button class="hover:text-red-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </button>
                <button class="relative hover:text-red-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full">0</span>
                </button>
                <a href="{{ route('login') }}" class="hover:text-red-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
            </div>
        </div>
    </div>
</nav>