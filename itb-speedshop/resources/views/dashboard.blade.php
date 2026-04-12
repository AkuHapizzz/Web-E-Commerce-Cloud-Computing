<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Inventory Management') }} <span class="text-red-600">ITB.SpeedShop</span>
            </h2>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-black transition-all shadow-lg shadow-red-100">
                + Tambah Produk Baru
            </a>
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
                                <th class="px-6 py-5 text-center">Foto</th>
                                <th class="px-6 py-5">Nama Produk</th>
                                <th class="px-6 py-5 text-center">Kategori</th>
                                <th class="px-6 py-5 text-right">Harga</th>
                                <th class="px-6 py-5 text-center">Stok</th>
                                <th class="px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors">
                                
                                <td class="px-6 py-4 text-center" style="width: 100px;">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="img" style="width: 60px; height: 60px; object-fit: cover; border-radius: 12px; margin: 0 auto; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    @else
                                        <div style="width: 60px; height: 60px; background: #f3f4f6; border-radius: 12px; margin: 0 auto; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: bold; color: #9ca3af; border: 1px dashed #d1d5db;">
                                            NO IMG
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900 uppercase">{{ $product->name }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">ID: #{{ $product->id }}</div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-[10px] font-bold uppercase tracking-widest">
                                        {{ $product->category }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <span class="text-sm font-black text-red-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm font-bold text-gray-900">
                                        {{ $product->stock }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-100 text-yellow-700 px-3 py-2 rounded-lg text-xs font-bold hover:bg-yellow-200 transition">
                                            EDIT
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-100 text-red-700 px-3 py-2 rounded-lg text-xs font-bold hover:bg-red-200 transition">
                                                HAPUS
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-bold italic">
                                    Belum ada barang di inventory.
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