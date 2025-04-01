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

        $total = DB::table('Bookings')->count();

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

    public function PopDestination(Request $request)
    {
        //makes variables for pagination

        $perPage = 25;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $total = DB::table('Bookings')->count();

        // try catch looks if the SP exists
        try{
            $Trips = DB::select('call ReadPopularDestinations(?, ?)', [$perPage, $offset]);

        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error reading popular destinations: ' . $e->getMessage());
            //makes an empty array if the SP doesn't exist
            $Trips = [];
        }
        
        //paginate

        $Trips = new LengthAwarePaginator($Trips, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        //redirect the user to the index page with all the users
        return view('management.popDestinations', ['Trips' => $Trips]);
   
    }
    public function ProfitPeriod(Request $request){
        //makes variables for pagination

        $perPage = 25;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $total = DB::table('Trips')->count();

        // try catch looks if the SP exists
        try{
            $Profit = DB::select('call ReadProfitPeriod(?, ?)', [$perPage, $offset]);

        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error reading profit per period: ' . $e->getMessage());
            //makes an empty array if the SP doesn't exist
            $Profit = [];
        }
        
        //paginate

        $Profit = new LengthAwarePaginator($Profit, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        //redirect the user to the index page with all the users
        return view('management.ProfitPeriod', ['Profits' => $Profit]);    
    }
}
