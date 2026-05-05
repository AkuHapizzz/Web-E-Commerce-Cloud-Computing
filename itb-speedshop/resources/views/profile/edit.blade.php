<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-3xl text-gray-900 leading-tight italic uppercase tracking-tighter">
                My <span class="text-red-600">Profile</span>
            </h2>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] px-4 py-2 rounded-full
                {{ $user->usertype === 'admin' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600' }}">
                {{ $user->usertype === 'admin' ? '🛠️ Admin' : '👤 Customer' }}
            </span>
        </div>
    </x-slot>

    <div class="py-16 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Minimalist Profile Hero Card --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative group/banner">
                {{-- Banner & Info Section --}}
                <div class="relative h-[200px] w-full">
                    {{-- Banner Image --}}
                    @if($user->profile_banner)
                        <img src="{{ asset('storage/' . $user->profile_banner) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-r from-gray-900 to-gray-800"></div>
                    @endif

                    {{-- Dark Overlay --}}
                    <div class="absolute inset-0 bg-black/40"></div>
                    
                    {{-- Edit Banner Button --}}
                    <label for="profile_banner" class="absolute top-4 right-4 bg-white/10 hover:bg-white/20 text-white p-2 rounded-xl backdrop-blur-md cursor-pointer opacity-0 group-hover/banner:opacity-100 transition-all duration-300 border border-white/20 z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        </svg>
                    </label>

                    {{-- User Overlay --}}
                    <div class="absolute inset-0 p-8 flex items-center gap-6 z-10">
                        {{-- Profile Photo --}}
                        <div class="relative group cursor-pointer shrink-0">
                            <label for="profile_photo" class="cursor-pointer block relative">
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-20 h-20 rounded-2xl object-cover shadow-lg border-2 border-white/30 group-hover:scale-105 transition-all duration-500">
                                @else
                                    <div class="w-20 h-20 rounded-2xl bg-red-600 flex items-center justify-center text-white font-black text-2xl shadow-lg border-2 border-white/30 group-hover:scale-105 transition-all duration-500">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                            </label>
                        </div>

                        {{-- Text Info --}}
                        <div>
                            <h3 class="text-white font-black text-2xl tracking-tight uppercase italic">{{ $user->name }}</h3>
                            <p class="text-white/70 text-sm font-medium">{{ $user->email }}</p>
                            <span class="inline-block mt-2 text-[8px] font-black uppercase tracking-[0.2em] px-2 py-0.5 rounded bg-red-600 text-white italic">
                                {{ $user->usertype }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Quick Stats Row --}}
                @if($user->usertype !== 'admin')
                <div class="grid grid-cols-3 divide-x divide-gray-100 border-t border-gray-100">
                    <div class="px-8 py-5 text-center">
                        <div class="text-2xl font-black text-gray-900">{{ $user->orders()->count() }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Total Pesanan</div>
                    </div>
                    <div class="px-8 py-5 text-center">
                        <div class="text-2xl font-black text-red-600">{{ $user->orders()->where('status', 'paid')->count() }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Selesai</div>
                    </div>
                    <div class="px-8 py-5 text-center">
                        <div class="text-2xl font-black text-yellow-500">{{ $user->orders()->where('status', 'pending')->count() }}</div>
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
