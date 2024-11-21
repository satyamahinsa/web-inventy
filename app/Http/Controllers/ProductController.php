<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');
        $query = Product::query();
    
        // Filter produk berdasarkan pencarian
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }
    
        // Filter produk berdasarkan kategori, jika kategori diberikan
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate(12); 
    
        $categories = Category::withCount('products')->get();
    
        $totalProducts = Product::count();
    
        $cart = Session::get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
    
        return view('products.index', compact('products', 'categories', 'cartCount', 'totalProducts', 'search', 'categoryId'));
    }
    

    public function addToCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);

        $quantity = $request->input('quantity');

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image'=> $product->image,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return view('cart.index', compact('cart', 'cartCount'));
    }

    public function create()
    {
        $products = Product::paginate(10); // Menampilkan 10 produk per halaman
        $categories = Category::all(); // Ambil semua kategori produk
        
        return view('products.create', compact('categories', 'products'));
    }
    
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', 
        ]);
    
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); 
        }
    
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $path, 
        ]);
    
        return redirect()->route('products.create')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Ambil kategori untuk pilihan pada edit
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:2048', // Validasi gambar opsional
    ]);

    $product = Product::findOrFail($id);

    // Perbarui data produk
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->category_id = $request->category_id;

    // Periksa jika ada gambar yang diunggah
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }
        // Simpan gambar baru
        $product->image = $request->file('image')->store('products', 'public');
    }

    $product->save();

    return redirect()->route('products.create')->with('success', 'Produk berhasil diperbarui!');
}
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.create')->with('success', 'Produk berhasil dihapus.');
    }
}
