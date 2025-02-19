<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Zorg ervoor dat je DB toevoegt voor query's
use App\Models\Trip;

class TripController extends Controller
{
    /**
     * Display a listing of the trips.
     */
    public function index(Request $request)
    {
        // Variabelen voor paginering
        $perPage = 25;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        // Haal het totaal aantal reizen op (voor paginering)
        $total = DB::table('trips')->count();

        // Probeer de opgeslagen procedure aan te roepen
        try {
            $trips = DB::select('CALL ReadTrips(?, ?)', [$perPage, $offset]);
        } catch (\Exception $e) {
            // Lege array als de procedure niet bestaat of een fout optreedt
            $trips = [];
        }

        // Maak een LengthAwarePaginator object voor paginering
        $trips = new \Illuminate\Pagination\LengthAwarePaginator(
            $trips, 
            $total, 
            $perPage, 
            $page, 
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        // Retourneer de view met de reizen
        return view('trips.index', ['trips' => $trips]);
    }
}
