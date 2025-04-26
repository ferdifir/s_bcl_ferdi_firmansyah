<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use App\Models\Checkin;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function create()
    {
        $fleets = Fleet::all();
        return view('checkins.create', compact('fleets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fleet_id' => 'required|exists:fleets,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        Checkin::create($data);

        return redirect()
            ->route('checkins.index')
            ->with('success', 'Check-in berhasil disimpan.');
    }

    public function index()
    {
        $fleets = Fleet::with('latestCheckin')->get();
        return view('checkins.index', compact('fleets'));
    }
}
