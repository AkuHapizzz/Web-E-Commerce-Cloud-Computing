<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-3xl text-gray-900 leading-tight italic uppercase tracking-tighter">
                Detail <span class="text-red-600">Pesanan</span>
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-400 hover:text-gray-900 uppercase tracking-widest flex items-center gap-2">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-16 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Summary Card --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-10 py-8 flex items-center justify-between gap-6">
                    <div>
                        <h3 class="text-white font-black text-2xl tracking-tight">Order #{{ $order->id }}</h3>
                        <p class="text-gray-400 text-sm mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        @if($order->status == 'pending')
                            <span class="px-6 py-2 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold uppercase tracking-widest border border-yellow-200 shadow-sm">Pending</span>
                        @elseif($order->status == 'paid')
                            <span class="px-6 py-2 bg-blue-100 text-blue-800 rounded-full text-xs font-bold uppercase tracking-widest border border-blue-200 shadow-sm">Paid</span>
                        @elseif($order->status == 'diproses')
                            <span class="px-6 py-2 bg-orange-100 text-orange-800 rounded-full text-xs font-bold uppercase tracking-widest border border-orange-200 shadow-sm">Diproses</span>
                        @elseif($order->status == 'dikirim')
                            <span class="px-6 py-2 bg-indigo-100 text-indigo-800 rounded-full text-xs font-bold uppercase tracking-widest border border-indigo-200 shadow-sm">Dikirim</span>
                        @elseif($order->status == 'selesai')
                            <span class="px-6 py-2 bg-green-100 text-green-800 rounded-full text-xs font-bold uppercase tracking-widest border border-green-200 shadow-sm">Selesai</span>
                        @elseif($order->status == 'failed' || $order->status == 'expired' || $order->status == 'cancelled')
                            <span class="px-6 py-2 bg-red-100 text-red-800 rounded-full text-xs font-bold uppercase tracking-widest border border-red-200 shadow-sm">{{ ucfirst($order->status) }}</span>
                        @else
                            <span class="px-6 py-2 bg-gray-100 text-gray-800 rounded-full text-xs font-bold uppercase tracking-widest border border-gray-200 shadow-sm">{{ ucfirst($order->status) }}</span>
                        @endif
                    </div>
                </div>

                <div class="p-10">
                    <h4 class="font-black text-lg text-gray-900 uppercase tracking-tight italic mb-6">Daftar Produk</h4>
                    
                    <div class="overflow-x-auto rounded-xl border border-gray-100">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-widest font-black">
                                <tr>
                                    <th class="px-6 py-4 border-b border-gray-100">Produk</th>
                                    <th class="px-6 py-4 border-b border-gray-100 text-center">Harga</th>
                                    <th class="px-6 py-4 border-b border-gray-100 text-center">Qty</th>
                                    <th class="px-6 py-4 border-b border-gray-100 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($order->items as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-bold text-gray-900">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 text-sm font-medium text-center">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 font-bold text-center">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 text-red-600 font-black text-right">
                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-400 font-bold italic">
                                            Tidak ada data produk.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-500 uppercase tracking-widest text-[10px]">
                                        Total Pembayaran
                                    </td>
                                    <td class="px-6 py-4 text-right text-xl font-black text-gray-900">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            @if($order->status == 'pending')
            <div class="bg-red-50 rounded-3xl border border-red-100 p-8 text-center">
                <p class="text-red-600 font-bold text-sm mb-4">Pesanan ini masih menunggu pembayaran.</p>
                <!-- This could redirect to payment page, but Midtrans Snap might be expired, so just a note for now -->
            </div>
            @endif
        </div>
    </div>
</x-app-layout>