@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Shipment Details</h1>

        @if($shipment)
            <table class="w-full table-auto border-collapse">
                <tbody>
                    <tr>
                        <th class="border px-4 py-2 text-left">Tracking Number</th>
                        <td class="border px-4 py-2">{{ $shipment->tracking_number }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left">Date</th>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($shipment->shipped_at)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left">Origin</th>
                        <td class="border px-4 py-2">{{ $shipment->origin }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left">Destination</th>
                        <td class="border px-4 py-2">{{ $shipment->destination }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left">Status</th>
                        <td class="border px-4 py-2 capitalize">{{ str_replace('_', ' ', $shipment->status) }}</td>
                    </tr>
                    <tr>
                        <th class="border px-4 py-2 text-left">Goods Detail</th>
                        <td class="border px-4 py-2">{{ $shipment->goods_detail }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="text-gray-700">Shipment not found.</p>
        @endif

    </div>
@endsection