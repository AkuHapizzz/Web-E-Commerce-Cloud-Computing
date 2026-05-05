<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-3xl text-gray-900 leading-tight italic uppercase tracking-tighter">
                {{ __('Riwayat Pemesanan') }} <span class="text-red-600">ITB.SpeedShop</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-16 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-2xl sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="p-8 lg:p-12 text-gray-900">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="font-extrabold text-2xl text-gray-900">Daftar Belanja Anda</h3>
                            <p class="text-gray-500 mt-1">Pantau semua transaksi dan pesanan Anda di sini.</p>
                        </div>
                        <div class="hidden md:block">
                            <span class="bg-red-50 text-red-600 px-4 py-2 rounded-full font-bold text-sm">Total Pesanan: {{ count($orders) }}</span>
                        </div>
                    </div>
                    
                    @if(count($orders) > 0)
                        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-widest font-black">
                                    <tr>
                                        <th class="px-8 py-5 border-b border-gray-200">No. Pesanan</th>
                                        <th class="px-8 py-5 border-b border-gray-200">Tanggal</th>
                                        <th class="px-8 py-5 border-b border-gray-200">Total</th>
                                        <th class="px-8 py-5 border-b border-gray-200 text-center">Status</th>
                                        <th class="px-8 py-5 border-b border-gray-200 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50 transition-colors group">
                                        <td class="px-8 py-5 font-bold text-gray-900">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold text-xl">
                                                    📦
                                                </div>
                                                <span>#{{ $order->id }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5 text-gray-600 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                        <td class="px-8 py-5 font-black text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="px-8 py-5 text-center">
                                            @if($order->status == 'pending')
                                                <span class="px-4 py-1.5 bg-yellow-100 text-yellow-800 rounded-full text-[10px] font-bold uppercase tracking-widest">Pending</span>
                                            @elseif($order->status == 'paid')
                                                <span class="px-4 py-1.5 bg-green-100 text-green-800 rounded-full text-[10px] font-bold uppercase tracking-widest">Paid</span>
                                            @else
                                                <span class="px-4 py-1.5 bg-gray-100 text-gray-800 rounded-full text-[10px] font-bold uppercase tracking-widest">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-5 text-center">
                                            <a href="{{ route('order.show', $order->id) }}" class="text-red-600 font-bold text-sm hover:underline">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-20 px-6 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto shadow-sm mb-6">
                                <svg class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Belum ada pesanan</h4>
                            <p class="text-gray-500 font-medium mb-8 max-w-md mx-auto">Anda belum melakukan transaksi apapun. Yuk, temukan sparepart impianmu di katalog kami!</p>
                            <a href="{{ url('/') }}" class="inline-flex items-center justify-center bg-red-600 text-white font-bold py-4 px-10 rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:-translate-y-1">
                                Mulai Belanja Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
