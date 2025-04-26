<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShipmentController;

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

// Shipment Tracking
Route::get('track', [ShipmentController::class, 'showForm'])
    ->name('shipments.form');

Route::post('track', [ShipmentController::class, 'track'])
    ->name('shipments.track');

// Fleet CRUD + Filter
Route::resource('fleets', FleetController::class);

// Booking
Route::get('bookings/create', [BookingController::class, 'create'])
    ->name('bookings.create');
Route::post('bookings', [BookingController::class, 'store'])
    ->name('bookings.store');

// Check-in
Route::get('checkins/create', [CheckinController::class, 'create'])
    ->name('checkins.create');
Route::post('checkins', [CheckinController::class, 'store'])
    ->name('checkins.store');
Route::get('checkins', [CheckinController::class, 'index'])
    ->name('checkins.index');

// Laporan
Route::get('reports/in-transit', [ReportController::class, 'inTransitPerFleet'])
    ->name('reports.in_transit');

Route::get('shipments', [ShipmentController::class, 'index'])
    ->name('shipments.index');
