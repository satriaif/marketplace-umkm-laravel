<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::latest()->paginate(10);

    return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'category_name' => 'required|max:100|unique:categories,category_name',
    ]);

    Category::create([
        'category_name' => $request->category_name,
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Kategori berhasil ditambahkan.');
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
    public function edit(Category $category)
    {
        //
         return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Category $category)
{
    $request->validate([
        'category_name' => 'required|max:100|unique:categories,category_name,' . $category->id,
    ]);

    $category->update([
        'category_name' => $request->category_name,
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Kategori berhasil diperbarui.');
}
    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Category $category)
{
    $category->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Kategori berhasil dihapus.');
}
}