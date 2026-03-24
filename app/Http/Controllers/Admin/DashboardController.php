<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Product;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalProduk   = Product::count();
        $totalBooking  = Booking::count();
        $bookingPending = Booking::where('status', 'pending')->count();
        $recentBookings = Booking::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProduk', 'totalBooking', 'bookingPending', 'recentBookings'
        ));
    }
}
