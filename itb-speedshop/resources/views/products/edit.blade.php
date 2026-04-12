<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6 text-yellow-600 border-b pb-2">Edit Produk: {{ $product->name }}</h2>
            
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-yellow-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ $product->price }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-yellow-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Stok Barang</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-yellow-500">
                </div>
                

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                    <select name="category" class="w-full border-gray-300 rounded shadow-sm">
                        <option value="Shockbreaker" {{ $product->category == 'Shockbreaker' ? 'selected' : '' }}>Shockbreaker</option>
                        <option value="Knalpot" {{ $product->category == 'Knalpot' ? 'selected' : '' }}>Knalpot</option>
                        <option value="Ban" {{ $product->category == 'Ban' ? 'selected' : '' }}>Ban</option>
                        <option value="Aksesoris" {{ $product->category == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2 uppercase text-xs">Deskripsi Produk</label>
                    <textarea name="description" rows="5" class="w-full border-gray-300 rounded-2xl shadow-sm focus:ring-red-500">{{ $product->description ?? '' }}</textarea>
                </div>


                <div class="mb-6 p-4 bg-gray-50 rounded-lg border">
                    <label class="block text-gray-700 font-semibold mb-2">Ganti Foto (Kosongkan jika tidak diubah)</label>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 object-cover mb-2 rounded">
                    @endif
                    <input type="file" name="image" class="w-full text-sm">
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 mr-4 hover:underline">Batal</a>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-bold shadow transition">
                        Update Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>