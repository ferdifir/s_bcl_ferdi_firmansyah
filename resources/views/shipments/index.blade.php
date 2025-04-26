@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center space-x-4">
        <form action="{{ route('shipments.index') }}" method="GET" class="flex space-x-2">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari nomor atau tujuan…"
                class="border rounded px-3 py-2">
            <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded">Cari</button>
        </form>
        <a href="{{ route('shipments.index') }}" class="text-sm text-gray-600 hover:underline">Reset</a>
    </div>

    <table class="w-full table-auto border-collapse bg-white shadow rounded">
        <thead>
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Tracking</th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Asal</th>
                <th class="border px-4 py-2">Tujuan</th>
                <th class="border px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shipments as $s)
                <tr>
                    <td class="border px-4 py-2">{{ $s->id }}</td>
                    <td class="border px-4 py-2">{{ $s->tracking_number }}</td>
                    <td class="border px-4 py-2">{{ $s->shipped_at->format('d M Y') }}</td>
                    <td class="border px-4 py-2">{{ $s->origin }}</td>
                    <td class="border px-4 py-2">{{ $s->destination }}</td>
                    <td class="border px-4 py-2 capitalize">{{ str_replace('_', ' ', $s->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border px-4 py-2 text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $shipments->links() }}
    </div>
@endsection