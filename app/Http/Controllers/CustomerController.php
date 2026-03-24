<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function bookings()
    {
        $bookings = auth()->user()->bookings()
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('customer.bookings', compact('bookings'));
    }
}
