<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Services\RecommendationService;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use App\Models\Rating;
use Illuminate\Http\Request;

class HomeController extends Controller
{
      public function index(RecommendationService $recommendationService, Request $request)
    {
        // Jika admin membuka halaman utama,
        // arahkan ke dashboard admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            
        return redirect()->route('admin.dashboard');
        }
            $recommendations = collect();

            $recommendations = collect();

                if (Auth::check()) {
                    $recommendations = $recommendationService
                        ->getRecommendations(Auth::id(), 5);
                }

                $query = Product::with(['category', 'seller']);

                if ($request->filled('category')) {
                    $query->where('category_id', $request->category);
                }

                if ($request->filled('search')) {
                    $query->where(function ($q) use ($request) {
                        $q->where('product_name', 'like', "%{$request->search}%")
                        ->orWhere('description', 'like', "%{$request->search}%");
                    });
                }
                $heroProducts = Product::latest()->take(4)->get();
            
               $products = $query->latest()
                ->paginate(12)
                ->withQueryString();

                if ($request->ajax()) {
                return view('frontend.partials.products', compact('products'));
                }

                $categories = Category::orderBy('category_name' )->get();

                $productCount = Product::count();
                $categoryCount = Category::count();
                $ratingCount = Rating::count();
                // $relatedProducts = Product::where('category_id', $product->category_id)
                //     ->where('id', '!=', $product->id)
                //     ->take(4)
                //     ->get();

                return view('frontend.home', compact(
                            'products',
                            'categories',
                            'productCount',
                            'categoryCount',
                            'ratingCount',
                            'heroProducts',
                            'recommendations'
                        ));
    }

//     public function search(Request $request)
// {
//     $keyword = $request->keyword;

//     $products = Product::query()

//         ->when($keyword, function ($query) use ($keyword) {

//             $query->where('product_name', 'like', '%' . $keyword . '%');

//         })

//         ->latest()

//         ->get();

//     return view('frontend.partials.products', compact('products'));
// }
}