<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-black text-white uppercase italic tracking-tight">Welcome Back</h2>
        <p class="text-sm text-gray-400 mt-2">Masuk ke akun Anda untuk melanjutkan.</p>
    </div>

    {{-- Clickable Role Cards - auto-fill credentials --}}
    <div class="grid grid-cols-2 gap-3 mb-6">
        {{-- Customer Card --}}
        <button type="button" onclick="fillCredentials('customer@speedshop.com','customer123')"
            class="bg-gray-800/60 border border-gray-700 hover:border-gray-500 rounded-xl p-3 text-center transition-all group cursor-pointer">
            <div class="text-xl mb-1">👤</div>
            <div class="text-[10px] font-black text-white uppercase tracking-widest">Customer</div>
            <div class="text-[9px] text-gray-400 mt-1 group-hover:text-gray-300">Klik untuk masuk</div>
        </button>
        {{-- Admin Card --}}
        <button type="button" onclick="fillCredentials('admin@speedshop.com','admin123')"
            class="bg-red-900/30 border border-red-800/50 hover:border-red-600 rounded-xl p-3 text-center transition-all group cursor-pointer">
            <div class="text-xl mb-1">🛠️</div>
            <div class="text-[10px] font-black text-red-400 uppercase tracking-widest">Admin</div>
            <div class="text-[9px] text-gray-400 mt-1 group-hover:text-gray-300">Klik untuk masuk</div>
        </button>
    </div>

    <script>
        function fillCredentials(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-red-600 hover:text-red-800 font-bold" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-red-600 text-white font-bold py-3 px-4 rounded-full hover:bg-black transition uppercase text-xs tracking-widest shadow-lg">
                {{ __('Log in') }}
            </button>
        </div>

        <div class="mt-8 text-center text-sm text-gray-600 pt-6 border-t border-gray-100">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-red-600 font-bold hover:underline">Buat Akun Customer</a>
        </div>
    </form>
</x-guest-layout>
