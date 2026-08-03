<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $sellers = Seller::latest()->paginate(10);

    return view('admin.sellers.index', compact('sellers'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('admin.sellers.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'seller_name' => 'required|max:255',
        'owner_name' => 'required|max:255',
        'phone' => 'nullable|max:20',
        'address' => 'nullable',
        'description' => 'nullable',
    ]);

    Seller::create($request->all());

    return redirect()
        ->route('admin.sellers.index')
        ->with('success', 'Seller berhasil ditambahkan.');
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
    public function edit(Seller $seller)
{
    return view('admin.sellers.edit', compact('seller'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seller $seller)
{
    $request->validate([
        'seller_name' => 'required|max:255',
        'owner_name' => 'required|max:255',
        'phone' => 'nullable|max:20',
        'address' => 'nullable',
        'description' => 'nullable',
    ]);

    $seller->update($request->all());

    return redirect()
        ->route('admin.sellers.index')
        ->with('success', 'Seller berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
{
    $seller->delete();

    return redirect()
        ->route('admin.sellers.index')
        ->with('success', 'Seller berhasil dihapus.');
}
}