<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Fetch bookings using the stored procedure
            $bookings = collect(DB::select('call ReadBookings()'));

            // Apply filters
            if ($request->has('destination') && $request->destination != '') {
                $bookings = $bookings->where('destination', $request->destination);
            }

            if ($request->has('purchase_date') && $request->purchase_date != '') {
                $bookings = $bookings->where('purchase_date', $request->purchase_date);
            }

            // Get current page form url e.g. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            // Define how many items we want to be visible in each page
            $perPage = 10;

            // Slice the collection to get the items to display in current page
            $currentPageItems = $bookings->slice(($currentPage - 1) * $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedBookings = new LengthAwarePaginator($currentPageItems, count($bookings), $perPage);

            // Append query parameters to pagination links
            $paginatedBookings->setPath($request->url());

            return view('Booking.index', compact('paginatedBookings'));
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database connection error: ' . $e->getMessage());
            return view('Booking.index', ['paginatedBookings' => [], 'error' => 'No data to be shown']);
        }
    }

    public function create()
    {
        $customers = Customer::all();
        $trips = Trip::all();

        return view('Booking.create', compact('customers', 'trips'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'trip_id' => 'required|exists:trip,id',
            'destination' => 'required|string|max:255',
            'seat_number' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'purchase_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'booking_status' => 'required|string|in:confirmed,pending,cancelled',
        ]);

        DB::statement('CALL InsertBooking(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $validatedData['customer_id'],
            $validatedData['trip_id'],
            $validatedData['destination'],
            $validatedData['seat_number'],
            $validatedData['purchase_date'],
            $validatedData['purchase_time'],
            $validatedData['price'],
            $validatedData['quantity'],
            $validatedData['booking_status'],
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking created successfully.');
    }

    public function overzicht()
    {
        return view('overzicht-booking');
    }

    public function edit(Booking $booking)
    {
        return view('Booking.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return redirect()->route('booking.index');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'The booking is successfully deleted');
    }
}
