<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $bestSellers = Product::where('best_seller', true)->latest()->limit(8)->get();
        $totalProduk = Product::count();
        $kategori    = ['motif', 'polos', 'premium'];
        return view('welcome', compact('bestSellers', 'totalProduk', 'kategori'));
    }

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('katalog.index', compact('products'));
    }

    public function show(Product $product)
    {
        $rekomendasi = $product->getRekomendasi(4);
        return view('katalog.show', compact('product', 'rekomendasi'));
    }
}
