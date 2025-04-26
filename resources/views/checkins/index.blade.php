@extends('layouts.app')

@section('title', 'Peta Check-In Armada')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Peta Check-In Armada</h1>
        <a href="{{ route('checkins.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">
            Check-In Armada
        </a>
    </div>

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

    <div id="map" style="height: 600px;"></div>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('map').setView([-7.75, 113.21], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            @foreach($fleets as $fleet)
                @if($fleet->latestCheckin)
                    L.marker([
                    {{ $fleet->latestCheckin->latitude }},
                        {{ $fleet->latestCheckin->longitude }}
                    ])
                        .bindPopup(
                            "<strong>{{ $fleet->number }}</strong><br>" +
                            "{{ $fleet->type }}<br>" +
                            "Check-In: {{ $fleet->latestCheckin->created_at->format('d M Y H:i') }}"
                        )
                        .addTo(map);
                @endif
            @endforeach
    });
    </script>
@endsection