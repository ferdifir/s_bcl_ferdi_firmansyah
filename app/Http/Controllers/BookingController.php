<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use App\Models\Shipment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Requests\StoreBookingRequest;

class BookingController extends Controller
{
    /**
     * Tampilkan form pemesanan.
     */
    public function create()
    {
        // ambil daftar jenis kendaraan yang tersedia
        $types = Fleet::where('is_available', true)
            ->distinct()
            ->pluck('type');

        return view('bookings.create', compact('types'));
    }

    /**
     * Proses pemesanan: 
     * - Buat Shipments
     * - Buat Booking
     * - Update status armada
     */
    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();

        // cari armada pertama yang cocok dan tersedia
        $fleet = Fleet::where('type', $data['type'])
            ->where('is_available', true)
            ->first();

        if (!$fleet) {
            return back()
                ->withInput()
                ->withErrors(['type' => 'Maaf, tidak ada armada tersedia untuk jenis kendaraan ini.']);
        }

        // generate tracking number unik
        $tracking = strtoupper('TRK-' . Str::random(8));

        // buat shipment baru
        $shipment = Shipment::create([
            'tracking_number' => $tracking,
            'shipped_at' => $data['booking_date'],
            'origin' => $data['origin'],
            'destination' => $data['destination'],
            'status' => 'pending',
            'goods_detail' => $data['goods_detail'],
        ]);

        // simpan booking
        Booking::create([
            'fleet_id' => $fleet->id,
            'shipment_id' => $shipment->id,
            'booking_date' => $data['booking_date'],
        ]);

        // update armada jadi tidak tersedia
        $fleet->update(['is_available' => false]);

        return redirect()
            ->route('shipments.track', ['tracking_number' => $tracking])
            ->with('success', "Pemesanan berhasil! Tracking Number: {$tracking}");
    }
}
