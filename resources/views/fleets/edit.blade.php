@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Armada #{{ $fleet->id }}</h1>

    <form action="{{ route('fleets.update', $fleet) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="number" class="block font-medium">Nomor Armada</label>
            <input type="text" name="number" id="number" value="{{ old('number', $fleet->number) }}"
                class="mt-1 block w-full border rounded px-3 py-2">
            @error('number') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="type" class="block font-medium">Jenis Kendaraan</label>
            <input type="text" name="type" id="type" value="{{ old('type', $fleet->type) }}"
                class="mt-1 block w-full border rounded px-3 py-2">
            @error('type') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="capacity" class="block font-medium">Kapasitas Muatan</label>
            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $fleet->capacity) }}"
                class="mt-1 block w-full border rounded px-3 py-2">
            @error('capacity') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_available" id="is_available" {{ old('is_available', $fleet->is_available) ? 'checked' : '' }}>
            <label for="is_available">Tersedia</label>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
            Update
        </button>
    </form>
@endsection