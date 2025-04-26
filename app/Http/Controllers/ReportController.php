<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fleet;

class ReportController extends Controller
{
    /**
     * Statistik jumlah pengiriman in_transit per armada.
     */
    public function inTransitPerFleet()
    {
        $stats = Fleet::leftJoin('bookings', 'fleets.id', '=', 'bookings.fleet_id')
            ->leftJoin('shipments', function ($join) {
                $join->on('bookings.shipment_id', '=', 'shipments.id')
                    ->where('shipments.status', 'in_transit');
            })
            ->select(
                'fleets.number as fleet_number',
                DB::raw('COUNT(shipments.id) as total_in_transit')
            )
            ->groupBy('fleets.number')
            ->orderBy('fleets.number')
            ->get();

        return view('reports.in_transit', compact('stats'));
    }
}
