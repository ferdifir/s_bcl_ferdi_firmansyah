@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Track Shipment</h1>
        <form action="{{ route('shipments.track') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="tracking_number" class="block text-sm font-medium">Tracking Number</label>
                <input type="text" name="tracking_number" id="tracking_number" value="{{ old('tracking_number') }}"
                    class="mt-1 block w-full border rounded px-3 py-2">
                @error('tracking_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Track
            </button>
        </form>
    </div>
@endsection