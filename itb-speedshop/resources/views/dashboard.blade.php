<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Riwayat Pemesanan') }} <span class="text-red-600">ITB.SpeedShop</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-xl sm:rounded-xl overflow-hidden border border-gray-200">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">Daftar Belanja Anda</h3>
                    
                    @if(count($orders) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-900 text-white uppercase text-[11px] tracking-widest font-bold">
                                    <tr>
                                        <th class="px-6 py-5">No. Pesanan</th>
                                        <th class="px-6 py-5">Tanggal</th>
                                        <th class="px-6 py-5">Total</th>
                                        <th class="px-6 py-5 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-bold text-gray-900">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 font-black text-red-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-lg text-xs font-bold uppercase">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <p class="text-gray-500 font-medium">Belum ada riwayat pemesanan.</p>
                            <a href="{{ url('/') }}" class="mt-4 inline-block bg-red-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-black transition-colors">
                                Mulai Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
