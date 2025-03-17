<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Zorg ervoor dat je DB toevoegt voor query's
use App\Models\Trip;
use App\Models\Departure;
use App\Models\Destination;
use Carbon\Carbon;


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

    /**
     * Show the form for creating a new trip.
     */
    public function create()
    {
        // Verkrijg de DepartureId en DestinationId uit je logica, bijvoorbeeld uit de database of een andere bron.
        $departureId = Departure::first()->id ?? 1; // Hier zoeken we naar een vertrekpunt, als er geen vertrekpunt is, zetten we 1 als fallback
        $destinationId = Destination::first()->id ?? 3; // Hetzelfde geldt voor bestemming

        // Gegevens doorgeven aan de view
        return view('trips.create', [
            'departureId' => $departureId,
            'destinationId' => $destinationId
        ]);
    }

    public function store(Request $request)
    {
        // Haal de ingelogde gebruiker op (of andere logica voor het invullen van de ID's)
        $user = auth()->user();
        
        // Controleer of de gebruiker ingelogd is
        if (!$user) {
            return back()->withErrors(['EmployeeId' => 'Geen ingelogde gebruiker gevonden.']);
        }
        
        // Validatie van de invoer
        $data = $request->validate([
            'EmployeeId' => 'required|integer',
            'DepartureId' => 'required|integer',
            'DestinationId' => 'required|integer',
            'FlightNumber' => 'required|alpha_num',
            'DepartureDate' => 'required|date_format:d-m-Y', // Formaat validatie d-m-Y
            'DepartureTime' => 'required|date_format:H:i',
            'ArrivalDate' => 'required|date_format:d-m-Y|after_or_equal:DepartureDate', // Formaat validatie d-m-Y
            'ArrivalTime' => 'required|date_format:H:i|after:DepartureTime',
            'TravelStatus' => 'required|string',
        ]);
        
        // Vul de ID's automatisch in
        $data['EmployeeId'] = $user->id; // Bijv. de ingelogde gebruiker als EmployeeId
        
        // Zet de datums om naar het juiste formaat voor opslag in de database (Y-m-d)
        try {
            // Controleer eerst of de datums correct zijn geformatteerd
            // dd($data['DepartureDate'], $data['ArrivalDate']); // Laat de data zien zoals ze zijn
    
            // Zet de datums om naar het juiste formaat voor opslag
            $data['DepartureDate'] = Carbon::createFromFormat('d-m-Y', $data['DepartureDate'])->format('Y-m-d');
            $data['ArrivalDate'] = Carbon::createFromFormat('d-m-Y', $data['ArrivalDate'])->format('Y-m-d');
            
            // Gebruik dd() om de datums te controleren, voor het geval er iets misgaat
            // dd($data['DepartureDate'], $data['ArrivalDate']); // Dit toont de geformatteerde datums
            
            // Probeer de gegevens op te slaan
            Trip::create($data);
    
            // Redirect naar de indexpagina met een succesmelding
            return redirect(route('trips.index'))->with('success', 'De reis is succesvol toegevoegd.');
        } catch (\Exception $e) {
            // Fout bij opslaan van de reis
            return back()->withErrors(['error' => 'Fout bij het opslaan van de reis: ' . $e->getMessage()]);
        }
    }
        
}