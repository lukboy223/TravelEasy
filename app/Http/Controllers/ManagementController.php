<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ManagementController extends Controller
{
    public function BookingPeriod(Request $request)
    {
        //makes variables for pagination

        $perPage = 25;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $total = DB::table('users')->count();

        // try catch looks if the SP exists
        try{
            $Bookings = DB::select('call ReadBookingPeriod(?, ?)', [$perPage, $offset]);

        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error reading bookings per period: ' . $e->getMessage());
            //makes an empty array if the SP doesn't exist
            $Bookings = [];
        }
        
        //paginate

        $Bookings = new LengthAwarePaginator($Bookings, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        //redirect the user to the index page with all the users
        return view('management.booking', ['Bookings' => $Bookings]);
   
    }
}
