<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-3xl text-gray-900 leading-tight italic uppercase tracking-tighter">
                My <span class="text-red-600">Profile</span>
            </h2>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] px-4 py-2 rounded-full
                {{ Auth::user()->usertype === 'admin' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600' }}">
                {{ Auth::user()->usertype === 'admin' ? '🛠️ Admin' : '👤 Customer' }}
            </span>
        </div>
    </x-slot>

    <div class="py-16 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Profile Hero Card --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-10 py-8 flex items-center gap-6">
                    <div class="w-20 h-20 rounded-2xl bg-red-600 flex items-center justify-center text-white font-black text-3xl shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-white font-black text-2xl tracking-tight">{{ Auth::user()->name }}</h3>
                        <p class="text-gray-400 text-sm mt-1">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-2 text-[9px] font-black uppercase tracking-[0.2em] px-3 py-1 rounded-full
                            {{ Auth::user()->usertype === 'admin' ? 'bg-red-600 text-white' : 'bg-white/10 text-gray-300' }}">
                            {{ Auth::user()->usertype === 'admin' ? 'Administrator' : 'Customer' }}
                        </span>
                    </div>
                </div>

                {{-- Quick Stats Row --}}
                @if(Auth::user()->usertype !== 'admin')
                <div class="grid grid-cols-3 divide-x divide-gray-100 border-t border-gray-100">
                    <div class="px-8 py-5 text-center">
                        <div class="text-2xl font-black text-gray-900">{{ Auth::user()->orders()->count() }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Total Pesanan</div>
                    </div>
                    <div class="px-8 py-5 text-center">
                        <div class="text-2xl font-black text-red-600">{{ Auth::user()->orders()->where('status', 'paid')->count() }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Selesai</div>
                    </div>
                    <div class="px-8 py-5 text-center">
                        <div class="text-2xl font-black text-yellow-500">{{ Auth::user()->orders()->where('status', 'pending')->count() }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Pending</div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Update Profile Information --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="px-10 py-6 border-b border-gray-100">
                    <h4 class="font-black text-lg text-gray-900 uppercase tracking-tight italic">Informasi Akun</h4>
                    <p class="text-sm text-gray-400 mt-1">Perbarui nama dan alamat email akun Anda.</p>
                </div>
                <div class="p-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="px-10 py-6 border-b border-gray-100">
                    <h4 class="font-black text-lg text-gray-900 uppercase tracking-tight italic">Ubah Password</h4>
                    <p class="text-sm text-gray-400 mt-1">Pastikan akun Anda menggunakan password yang kuat dan aman.</p>
                </div>
                <div class="p-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="bg-white rounded-3xl shadow-xl border border-red-100 overflow-hidden">
                <div class="px-10 py-6 border-b border-red-100">
                    <h4 class="font-black text-lg text-red-600 uppercase tracking-tight italic">Zona Bahaya</h4>
                    <p class="text-sm text-gray-400 mt-1">Hapus akun Anda secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="p-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
