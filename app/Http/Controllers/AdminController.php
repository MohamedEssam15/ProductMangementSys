<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 1)->count();
        $categories = Category::count();
        $inactiveProducts = Product::where('status', 0)->count();
        $recentProducts = Product::take(5)->get();

        return view('admin.dashboard', compact('totalProducts', 'activeProducts', 'inactiveProducts', 'categories', 'recentProducts'));
    }
}
