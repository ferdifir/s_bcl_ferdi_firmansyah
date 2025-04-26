@extends('layouts.app')

@section('title', 'Check-In Armada')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Check-In Armada</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('checkins.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="fleet_id" class="block font-medium">Pilih Armada</label>
                <select name="fleet_id" id="fleet_id" class="mt-1 block w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Armada --</option>
                    @foreach($fleets as $fleet)
                        <option value="{{ $fleet->id }}" {{ old('fleet_id') == $fleet->id ? 'selected' : '' }}>
                            {{ $fleet->number }} ({{ $fleet->type }})
                        </option>
                    @endforeach
                </select>
                @error('fleet_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="latitude" class="block font-medium">Latitude</label>
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                    class="mt-1 block w-full border rounded px-3 py-2">
                @error('latitude') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="longitude" class="block font-medium">Longitude</label>
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                    class="mt-1 block w-full border rounded px-3 py-2">
                @error('longitude') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded">
                Submit Check-In
            </button>
        </form>
    </div>
@endsection