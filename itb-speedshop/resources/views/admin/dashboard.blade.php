<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Panel Admin') }} <span class="text-red-600 uppercase tracking-tighter">ITB.SpeedShop</span>
            </h2>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-800 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-black transition-all shadow-lg">
                    Manajemen Pesanan
                </a>
                <a href="{{ route('products.create') }}" class="inline-flex items-center px-5 py-2.5 bg-red-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-black transition-all shadow-lg shadow-red-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Produk
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen" x-data="{ tab: 'inventory', viewMode: 'list' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="bg-green-600 text-white px-6 py-4 rounded-xl mb-8 shadow-lg flex justify-between items-center animate-fade-in-down">
                    <span class="font-bold text-sm uppercase tracking-widest flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </span>
                    <button @click="$el.parentElement.remove()" class="font-bold hover:text-gray-200 transition">&times;</button>
                </div>
            @endif

            <!-- Dashboard Navigation & Filters -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div class="flex bg-white p-1 rounded-2xl shadow-sm border border-gray-200 w-full md:w-auto">
                    <button @click="tab = 'inventory'" :class="tab === 'inventory' ? 'bg-red-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest transition-all duration-200 flex-1 md:flex-none">
                        Inventory
                    </button>
                    <button @click="tab = 'orders'" :class="tab === 'orders' ? 'bg-red-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest transition-all duration-200 flex-1 md:flex-none">
                        Pesanan
                    </button>
                </div>

                <!-- View Mode Toggle (Only for Inventory) -->
                <div class="flex items-center gap-3 bg-white p-1 rounded-2xl shadow-sm border border-gray-200" x-show="tab === 'inventory'">
                    <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-gray-100 text-red-600' : 'text-gray-400 hover:text-gray-600'" class="p-2 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    </button>
                    <button @click="viewMode = 'grid'" :class="viewMode === 'grid' ? 'bg-gray-100 text-red-600' : 'text-gray-400 hover:text-gray-600'" class="p-2 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Tab: Inventory -->
            <div x-show="tab === 'inventory'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4">
                
                <!-- Stock Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Produk -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total Produk</p>
                                <h3 class="text-3xl font-black text-gray-900 mt-1">{{ $products->count() }}</h3>
                            </div>
                            <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-xl shadow-sm border border-gray-100">
                                📦
                            </div>
                        </div>
                    </div>

                    <!-- Stok Menipis -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-yellow-600 uppercase tracking-widest">Stok Menipis</p>
                                <h3 class="text-3xl font-black text-yellow-600 mt-1">{{ $products->where('stock', '<=', 5)->where('stock', '>', 0)->count() }}</h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center text-xl shadow-sm border border-yellow-100">
                                ⚠️
                            </div>
                        </div>
                        <p class="text-[9px] text-gray-400 mt-2 font-bold uppercase tracking-widest">* Stok <= 5</p>
                    </div>

                    <!-- Stok Habis -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-red-600 uppercase tracking-widest">Stok Habis</p>
                                <h3 class="text-3xl font-black text-red-600 mt-1">{{ $products->where('stock', 0)->count() }}</h3>
                            </div>
                            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-xl shadow-sm border border-red-100">
                                ❌
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- List Mode (Explorer Details) -->
                <div x-show="viewMode === 'list'" class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-widest font-bold">
                                <tr>
                                    <th class="px-6 py-4 text-center">Foto</th>
                                    <th class="px-6 py-4">Nama Produk / SKU</th>
                                    <th class="px-6 py-4 text-center">Kategori</th>
                                    <th class="px-6 py-4 text-right">Harga</th>
                                    <th class="px-6 py-4 text-center">Stok</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($products as $product)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-center">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="img" class="w-12 h-12 object-cover rounded-xl mx-auto shadow-sm">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-xl mx-auto flex items-center justify-center text-[8px] font-bold text-gray-400 border border-dashed border-gray-300">NO IMG</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-900 uppercase leading-none">{{ $product->name }}</div>
                                        <div class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-1.5">UID: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-gray-200">
                                            {{ $product->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-black text-red-600">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm font-bold {{ $product->stock < 5 ? 'text-orange-500' : 'text-gray-900' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('products.edit', $product->id) }}" class="p-2 bg-yellow-50 text-yellow-600 rounded-xl hover:bg-yellow-100 transition shadow-sm border border-yellow-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition shadow-sm border border-red-100">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-bold italic uppercase tracking-widest">Inventory Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Grid Mode (Large Icons) -->
                <div x-show="viewMode === 'grid'" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:border-red-200 transition-all group relative">
                        <div class="aspect-square bg-gray-50 overflow-hidden relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 font-black italic">NO IMAGE</div>
                            @endif
                            <div class="absolute top-3 right-3 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('products.edit', $product->id) }}" class="bg-white p-2 rounded-full shadow-lg text-yellow-600 hover:bg-yellow-50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-xs uppercase text-gray-900 truncate mb-1">{{ $product->name }}</h4>
                            <p class="text-[10px] font-black text-red-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-tighter">Stok: {{ $product->stock }}</span>
                                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-tighter">{{ $product->category }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>

            <!-- Tab: Orders -->
            <div x-show="tab === 'orders'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4">
                <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-widest font-bold">
                                <tr>
                                    <th class="px-6 py-4">ID Pesanan</th>
                                    <th class="px-6 py-4">Pelanggan</th>
                                    <th class="px-6 py-4">Item</th>
                                    <th class="px-6 py-4 text-right">Total</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4">Tanggal</th>
                                    <th class="px-6 py-4 text-right">Kelola</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($orders as $order)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-black text-gray-900">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-xs font-bold text-gray-800 uppercase leading-none">{{ $order->user->name }}</div>
                                        <div class="text-[9px] text-gray-400 font-bold mt-1 lowercase">{{ $order->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-[9px] font-bold text-gray-600 uppercase">
                                            {{ $order->items->count() }} Produk
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-black text-red-600">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                'paid' => 'bg-green-100 text-green-700 border-green-200',
                                                'shipped' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'completed' => 'bg-gray-100 text-gray-700 border-gray-200',
                                                'failed' => 'bg-red-100 text-red-700 border-red-200',
                                                'expired' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                            ];
                                            $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $color }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-[10px] font-bold text-gray-500 uppercase">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="inline-flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-[9px] font-black uppercase tracking-tighter border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 py-1 pl-2 pr-8">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Done</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-bold italic uppercase tracking-widest">Belum ada pesanan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            </div>

        </div>
    </div>

    <style>
        .animate-fade-in-down {
            animation: fadeInDown 0.5s ease-out;
        }
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>
