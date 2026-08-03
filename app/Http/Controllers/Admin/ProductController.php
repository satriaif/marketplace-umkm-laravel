<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    //    $products = Product::with(['category', 'seller'])
    // ->latest()
    // ->paginate(10);

    // $products = Product::with('category')->get();

    $products = Product::with(['category', 'seller'])
    ->latest()
    ->get();

    return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $categories = Category::orderBy('category_name')->get();
    $sellers = Seller::orderBy('seller_name')->get();

    return view('admin.products.create', compact(
        'categories',
        'sellers'
    ));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
    'seller_id' => 'required|exists:sellers,id',
    'category_id' => 'required|exists:categories,id',
    'product_name' => 'required|max:255',
    'description' => 'required',
    'price' => 'required|numeric|min:0',
    'stock' => 'required|integer|min:0',
    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
]);

    $imageName = null;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('products', $imageName, 'public');
    }

    Product::create([
    'seller_id' => $request->seller_id,
    'category_id' => $request->category_id,
    'product_name' => $request->product_name,
    'description' => $request->description,
    'price' => $request->price,
    'stock' => $request->stock,
    'image' => $imageName,
]);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Product $product)
{
    $categories = Category::orderBy('category_name')->get();
    $sellers = Seller::orderBy('seller_name')->get();

    return view('admin.products.edit', compact(
        'product',
        'categories',
        'sellers'
    ));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'product_name' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {

        if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        $imageName = time() . '.' . $request->image->extension();

        $request->image->storeAs(
            'products',
            $imageName,
            'public'
        );

        $product->image = $imageName;
    }

   $product->update([
    'seller_id' => $request->seller_id,
    'category_id' => $request->category_id,
    'product_name' => $request->product_name,
    'description' => $request->description,
    'price' => $request->price,
    'stock' => $request->stock,
    'image' => $product->image,
]);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Produk berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Product $product)
{
    if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {

        Storage::disk('public')->delete('products/' . $product->image);

    }

    $product->delete();

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Produk berhasil dihapus.');
}
}