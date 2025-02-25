<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Trip;

class TripController extends Controller
{
    /**
     * Toont een lijst met trips, met paginering.
     *
     * @param  Request  $request  De HTTP-request met eventuele paginering parameters.
     * @return \Illuminate\View\View  De weergave met de lijst van trips.
     */
    public function index(Request $request)
    {
        // Aantal trips per pagina
        $perPage = 25;

        // Huidige pagina ophalen, standaard pagina 1
        $page = $request->input('page', 1);

        // Bereken de offset voor SQL-query (gebaseerd op paginering)
        $offset = ($page - 1) * $perPage;

        // Haal het totale aantal trips op voor paginering
        $total = DB::table('trips')->count();

        try {
            // Log de oproep van de stored procedure
            \Log::info("Oproep naar ReadTrips met limit: $perPage en offset: $offset");

            // Roep de stored procedure aan
            $trips = DB::select('CALL ReadTrips(?, ?)', [$perPage, $offset]);

        } catch (\Exception $e) {
            // Log een foutmelding als de stored procedure mislukt
            \Log::error('Fout bij uitvoeren van ReadTrips: ' . $e->getMessage());

            // Stuur de gebruiker terug met een foutmelding
            return redirect()->back()->with('error', 'Er is een probleem opgetreden bij het ophalen van trips.');
        }

        // Maak een paginatie-object aan met de opgehaalde trips
        $trips = new LengthAwarePaginator($trips, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        // Retourneer de trips aan de bijbehorende Blade-view
        return view('trips.index', compact('trips'));
    }
}
