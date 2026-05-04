<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-red-600 text-white px-8 py-3.5 rounded-full font-bold hover:bg-black transition-all duration-300 transform hover:-translate-y-1 uppercase text-[10px] tracking-widest shadow-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
