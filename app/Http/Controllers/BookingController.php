<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    const JAM_OPERASIONAL = [
        '08:00', '09:00', '10:00', '11:00',
        '13:00', '14:00', '15:00', '16:00',
    ];

    public function create(Request $request)
    {
        $tanggal     = $request->get('tanggal', date('Y-m-d'));
        $bookedSlots = Booking::getBookedSlots($tanggal);
        $jamList     = self::JAM_OPERASIONAL;

        return view('booking.create', compact('tanggal', 'bookedSlots', 'jamList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string|max:100',
            'no_hp'         => 'required|string|max:20',
            'tanggal'       => 'required|date|after_or_equal:today',
            'jam'           => 'required|in:' . implode(',', self::JAM_OPERASIONAL),
            'catatan'       => 'nullable|string|max:300',
        ]);

        if (Booking::isSlotTaken($request->tanggal, $request->jam . ':00')) {
            return back()->withInput()->withErrors([
                'jam' => 'Maaf, jam ' . $request->jam . ' pada tanggal tersebut sudah dipesan. Pilih jam lain.'
            ]);
        }

        Booking::create([
            'user_id'       => auth()->id(), // null jika tidak login
            'nama_customer' => $request->nama_customer,
            'no_hp'         => $request->no_hp,
            'tanggal'       => $request->tanggal,
            'jam'           => $request->jam . ':00',
            'catatan'       => $request->catatan,
            'status'        => 'pending',
        ]);

        return redirect()->route('booking.success');
    }

    public function success()
    {
        return view('booking.success');
    }

    public function getBookedSlots(Request $request)
    {
        $request->validate(['tanggal' => 'required|date']);
        return response()->json(Booking::getBookedSlots($request->tanggal));
    }
}
