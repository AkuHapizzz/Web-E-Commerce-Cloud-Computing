<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Tambahkan image)
        $request->validate([
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'stock' => 'required|integer',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Batas 2MB
        ]);

        // 2. Simpan data teks dulu ke variabel $product
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description ?? 'Produk ITB.SpeedShop',
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
        ]);

        // 3. LOGIKA UPLOAD GAMBAR (Taruh di sini)
        if ($request->hasFile('image')) {
            // Simpan file ke folder storage/app/public/products
            $path = $request->file('image')->store('products', 'public');

            // Update kolom image di database dengan path filenya
            $product->image = $path;
            $product->save();
        }

        return redirect()->route('dashboard')->with('success', 'Produk dan foto berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Cari produk berdasarkan slug, kalau tidak ada kasih error 404
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Ambil semua data input kecuali image dulu
        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);

        // Jika ada upload foto baru
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('dashboard')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete(); // Menghapus dari Supabase

        return redirect()->route('dashboard')->with('success', 'Produk berhasil dibuang!');
    }

    public function categories(Request $request)
    {
        // Mulai query pencarian produk
        $query = Product::query();

        // Cek apakah user mengklik kategori tertentu
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Ambil produk (12 per halaman) dan sertakan parameter filter agar paginasinya tidak error
        $products = $query->paginate(12)->appends($request->all());

        // Ambil 5 produk untuk sidebar
        $bestSellers = Product::inRandomOrder()->take(5)->get();

        // Kirim data ke view
        return view('categories', compact('products', 'bestSellers'));
    }
}
