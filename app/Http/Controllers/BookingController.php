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

        return view('Booking.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'CustmerId' => 'required|exists:customers,id',
            'TripId' => 'required|exists:trips,id',
            'seat_number' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'purchase_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'booking_status' => 'required|string|in:confirmed,pending,cancelled',
        ]);
        try {

            DB::statement('CALL CreateBooking(?, ?, ?, ?, ?, ?, ?, ?)', [
                $validatedData['CustmerId'],
                $validatedData['TripId'],
                $validatedData['seat_number'],
                $validatedData['purchase_date'],
                $validatedData['purchase_time'],
                $validatedData['price'],
                $validatedData['quantity'],
                $validatedData['booking_status'],
            ]);


            return redirect()->route('booking.index')->with('success', 'Booking created successfully.');
        } catch (\Exception $e) {
            Log::error('error creating the booking: ' . $e->getMessage());
            return redirect()->route('booking.create')->with('error', 'Fout opgetreden bij het aanmaken van de nieuwe boeking');
        }
    }

    public function overzicht()
    {
        return view('overzicht-booking');
    }


    public function edit($id)
    {
        try {
            $data = DB::select('CALL ReadBooking(?)', [$id]);
            // dd($data);

            return view('Booking.update', ['Booking' => $data]);
        } catch (\Exception $e) {
            Log::error('error editing the booking: ' . $e->getMessage());
        }
    }
//validation
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'CustmerId' => 'required|exists:customers,id',
            'TripId' => 'required|exists:trips,id',
            'seat_number' => 'required|string|max:100',
            'purchase_date' => 'required|date|before:today|after:2025-01-01',
            'purchase_time' => 'required|date_format:H:i:s',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'booking_status' => 'required|string|in:confirmed,pending,cancelled',
        ]);

        try {
            DB::statement('CALL UpdateBooking(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $validatedData['CustmerId'],
                $validatedData['TripId'],
                $validatedData['seat_number'],
                $validatedData['purchase_date'],
                $validatedData['purchase_time'],
                $validatedData['price'],
                $validatedData['quantity'],
                $validatedData['booking_status'],
            ]);

            return redirect()->route('booking.index')->with('success', 'Booking updated successfully.');
        } catch (\Exception $e) {
            Log::error('error updating the booking: ' . $e->getMessage());
            return redirect()->route('booking.edit', ['booking' => $id])->with('error', 'Fout opgetreden bij het wijzigen van de boeking');
        }
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'The booking is successfully deleted');
    }
}
