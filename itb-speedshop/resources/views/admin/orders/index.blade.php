<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Manajemen Pesanan') }} <span class="text-red-600">ITB.SpeedShop</span>
            </h2>
            <div class="flex gap-4">
                <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full font-bold text-sm">Total Produk Terjual: {{ $totalSold }}</span>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-black transition-all shadow-lg">
                    Kelola Produk
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-600 text-white px-6 py-4 rounded-xl mb-8 shadow-lg flex justify-between items-center">
                    <span class="font-bold text-sm uppercase tracking-widest">✅ {{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="font-bold">&times;</button>
                </div>
            @endif

            <div class="bg-white shadow-xl sm:rounded-xl overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-900 text-white uppercase text-[11px] tracking-widest font-bold">
                            <tr>
                                <th class="px-6 py-5">No. Pesanan</th>
                                <th class="px-6 py-5">Pelanggan</th>
                                <th class="px-6 py-5">Produk</th>
                                <th class="px-6 py-5 text-right">Total Harga</th>
                                <th class="px-6 py-5 text-center">Status</th>
                                <th class="px-6 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    #{{ $order->id }}
                                    <div class="text-[10px] text-gray-400 font-bold mt-1">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $order->user->name }}</div>
                                    <div class="text-[11px] text-gray-500 font-medium">{{ $order->user->email }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        @foreach($order->items as $item)
                                            <div class="text-sm text-gray-700">
                                                <span class="font-bold">{{ $item->quantity }}x</span> {{ $item->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <span class="text-sm font-black text-red-600">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if($order->status == 'pending')
                                        <span class="px-3 py-1.5 bg-yellow-100 text-yellow-800 rounded-lg text-[10px] font-bold uppercase tracking-widest">Pending</span>
                                    @elseif($order->status == 'paid')
                                        <span class="px-3 py-1.5 bg-blue-100 text-blue-800 rounded-lg text-[10px] font-bold uppercase tracking-widest">Paid</span>
                                    @elseif($order->status == 'diproses')
                                        <span class="px-3 py-1.5 bg-orange-100 text-orange-800 rounded-lg text-[10px] font-bold uppercase tracking-widest">Diproses</span>
                                    @elseif($order->status == 'dikirim')
                                        <span class="px-3 py-1.5 bg-indigo-100 text-indigo-800 rounded-lg text-[10px] font-bold uppercase tracking-widest">Dikirim</span>
                                    @elseif($order->status == 'selesai')
                                        <span class="px-3 py-1.5 bg-green-100 text-green-800 rounded-lg text-[10px] font-bold uppercase tracking-widest">Selesai</span>
                                    @else
                                        <span class="px-3 py-1.5 bg-gray-100 text-gray-800 rounded-lg text-[10px] font-bold uppercase tracking-widest">{{ $order->status }}</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline-flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="text-xs font-bold uppercase tracking-widest border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                        <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-black transition">
                                            UPDATE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-bold italic">
                                    Belum ada pesanan masuk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
