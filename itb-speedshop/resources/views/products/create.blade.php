<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Tambah Produk Baru
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-red-600 transition">
                &larr; Kembali ke Inventory
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 p-8">
                
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Nama Produk</label>
                        <input type="text" name="name" required class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 bg-gray-50 p-3" placeholder="Contoh: Shockbreaker Ohlins Depan Vario">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Harga (Rp)</label>
                            <input type="number" name="price" required class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 bg-gray-50 p-3" placeholder="Contoh: 2500000">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Stok Awal</label>
                            <input type="number" name="stock" required class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 bg-gray-50 p-3" placeholder="Contoh: 10">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Kategori Part</label>
                        <select name="category" required class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 bg-gray-50 p-3">
                            <option value="">-- Pilih Kategori --</option>
                            @php
                                $categories = ['Shock Depan', 'Shock Belakang', 'Velg', 'Ban', 'Piringan', 'Kaliper Rem', 'Master Rem', 'Selang Rem', 'Knalpot', 'Part Part CVT', 'Filter Udara', 'Busi', 'Cover Radiator', 'Cover Knalpot', 'Hugger', 'Visor', 'Body Kasar', 'Karpet Dek', 'Emblem', 'Baut', 'Spion', 'Handgrip', 'Jalu Stang', 'Cover Jok'];
                            @endphp
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Deskripsi Lengkap & Spesifikasi</label>
                        <textarea name="description" rows="5" class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 bg-gray-50 p-3" placeholder="Tuliskan spesifikasi, bahan, ukuran, dll..."></textarea>
                    </div>

                    <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center bg-gray-50 hover:bg-red-50 hover:border-red-300 transition cursor-pointer">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2 cursor-pointer">Upload Foto Produk</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-red-600 text-white px-8 py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-black transition-all shadow-lg shadow-red-200">
                            Simpan ke Database
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>