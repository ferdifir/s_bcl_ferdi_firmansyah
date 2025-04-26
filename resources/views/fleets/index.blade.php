@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Armada</h1>
        <a href="{{ route('fleets.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">Tambah Armada</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 grid grid-cols-3 gap-4">
        <form method="GET" action="{{ route('fleets.index') }}" class="col-span-2 flex space-x-2">
            <select name="type" class="border rounded px-3 py-2">
                <option value="">Semua Jenis</option>
                @foreach($types as $t)
                    <option value="{{ $t }}" {{ $type == $t ? 'selected' : '' }}>
                        {{ $t }}
                    </option>
                @endforeach
            </select>

            <select name="availability" class="border rounded px-3 py-2">
                <option value="">Semua Status</option>
                <option value="available" {{ $avail == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="unavailable" {{ $avail == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>

            <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded">Filter</button>
        </form>

        <a href="{{ route('fleets.index') }}" class="self-end text-sm text-gray-600 hover:underline">Reset</a>
    </div>


    <table class="w-full table-auto border-collapse bg-white shadow rounded">
        <thead>
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Nomor</th>
                <th class="border px-4 py-2">Jenis</th>
                <th class="border px-4 py-2">Kapasitas</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fleets as $fleet)
                <tr>
                    <td class="border px-4 py-2">{{ $fleet->id }}</td>
                    <td class="border px-4 py-2">{{ $fleet->number }}</td>
                    <td class="border px-4 py-2">{{ $fleet->type }}</td>
                    <td class="border px-4 py-2">{{ $fleet->capacity }}</td>
                    <td class="border px-4 py-2">
                        @if($fleet->is_available)
                            <span class="text-green-600 font-semibold">Tersedia</span>
                        @else
                            <span class="text-red-600 font-semibold">Tidak Tersedia</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('fleets.edit', $fleet) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>

                        <form action="{{ route('fleets.destroy', $fleet) }}" method="POST" class="inline"
                            onsubmit="return confirm('Hapus armada ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $fleets->links() }}
    </div>
@endsection