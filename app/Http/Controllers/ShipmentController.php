<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $shipments = Shipment::when(
            $q,
            fn($query) =>
            $query->where('tracking_number', 'like', "%{$q}%")
                ->orWhere('destination', 'like', "%{$q}%")
        )
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('shipments.index', compact('shipments', 'q'));
    }


    public function showForm()
    {
        return view('shipments.track-form');
    }

    public function track(Request $request)
    {
        $data = $request->validate([
            'tracking_number' => 'required|string|exists:shipments,tracking_number',
        ]);

        $shipment = Shipment::where('tracking_number', $data['tracking_number'])
            ->first();

        return view('shipments.track-result', compact('shipment'));
    }
}
