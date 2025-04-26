@extends('layouts.app')

@section('title', 'Laporan Pengiriman In Transit')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Laporan Pengiriman “In Transit”</h1>
        <a href="{{ route('reports.in_transit') }}" class="text-sm text-gray-600 hover:underline">Refresh</a>
    </div>

    <table class="w-full table-auto border-collapse bg-white shadow rounded">
        <thead>
            <tr>
                <th class="border px-4 py-2">No. Armada</th>
                <th class="border px-4 py-2">Jumlah In Transit</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stats as $row)
                <tr>
                    <td class="border px-4 py-2">{{ $row->fleet_number }}</td>
                    <td class="border px-4 py-2 text-center">{{ $row->total_in_transit }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border px-4 py-2 text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection