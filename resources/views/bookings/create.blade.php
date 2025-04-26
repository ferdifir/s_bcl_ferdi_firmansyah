@extends('layouts.app')

@section('title', 'Pemesanan Armada')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Pemesanan Armada</h1>

        {{-- Error umum --}}
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Jenis Kendaraan --}}
            <div>
                <label for="type" class="block font-medium">Jenis Kendaraan</label>
                <select name="type" id="type" class="mt-1 block w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal Pemesanan --}}
            <div>
                <label for="booking_date" class="block font-medium">Tanggal Pemesanan</label>
                <input type="date" name="booking_date" id="booking_date"
                    value="{{ old('booking_date', now()->format('Y-m-d')) }}"
                    class="mt-1 block w-full border rounded px-3 py-2">
            </div>

            {{-- Origin --}}
            <div>
                <label for="origin" class="block font-medium">Lokasi Asal</label>
                <input type="text" name="origin" id="origin" value="{{ old('origin') }}"
                    class="mt-1 block w-full border rounded px-3 py-2" placeholder="Contoh: Jakarta">
            </div>

            {{-- Destination --}}
            <div>
                <label for="destination" class="block font-medium">Lokasi Tujuan</label>
                <input type="text" name="destination" id="destination" value="{{ old('destination') }}"
                    class="mt-1 block w-full border rounded px-3 py-2" placeholder="Contoh: Surabaya">
            </div>

            {{-- Detail Barang --}}
            <div>
                <label for="goods_detail" class="block font-medium">Detail Barang</label>
                <textarea name="goods_detail" id="goods_detail" rows="4" class="mt-1 block w-full border rounded px-3 py-2"
                    placeholder="Deskripsikan barang yang akan dikirim…">{{ old('goods_detail') }}</textarea>
            </div>

            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded">
                Pesan Armada
            </button>
        </form>
    </div>
@endsection