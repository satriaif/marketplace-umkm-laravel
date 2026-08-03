<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalUsers = User::count();

        $totalCategories = Category::count();

        $totalProducts = Product::count();

        $totalOrders = Order::count();

        $totalRevenue = Order::where('status', 'completed')
            ->sum('total_price');

        $pendingOrders = Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCategories',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'pendingOrders'
        ));
    }
}