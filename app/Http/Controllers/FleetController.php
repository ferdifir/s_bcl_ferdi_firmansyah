<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type');
        $avail = $request->input('availability');

        $fleets = Fleet::when($type, fn($q) => $q->where('type', $type))
            ->when(
                $avail !== null,
                fn($q) =>
                $q->where('is_available', $avail === 'available')
            )
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        // untuk dropdown filter jenis
        $types = Fleet::distinct()->pluck('type');

        return view('fleets.index', compact('fleets', 'types', 'type', 'avail'));
    }


    public function create()
    {
        return view('fleets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|unique:fleets,number',
            'type' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'is_available' => 'sometimes|boolean',
        ]);

        // default tersedia jika tidak diset
        $data['is_available'] = $request->has('is_available');

        Fleet::create($data);

        return redirect()->route('fleets.index')
            ->with('success', 'Armada berhasil ditambah.');
    }

    public function edit(Fleet $fleet)
    {
        return view('fleets.edit', compact('fleet'));
    }

    public function update(Request $request, Fleet $fleet)
    {
        $data = $request->validate([
            'number' => "required|unique:fleets,number,{$fleet->id}",
            'type' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'is_available' => 'sometimes|boolean',
        ]);

        $data['is_available'] = $request->has('is_available');

        $fleet->update($data);

        return redirect()->route('fleets.index')
            ->with('success', 'Armada berhasil diubah.');
    }

    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        return redirect()->route('fleets.index')
            ->with('success', 'Armada berhasil dihapus.');
    }
}
