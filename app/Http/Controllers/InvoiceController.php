<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use App\Models\Invoice;
use App\Models\Booking;
use Carbon\Carbon;


class InvoiceController extends Controller
{
    /**
     * Toont een lijst met facturen, met paginering.
     *
     * @param  Request  $request  De HTTP-request met eventuele paginering parameters.
     * @return \Illuminate\View\View  De weergave met de lijst van facturen.
     */
    public function index(Request $request)
    {
        // Aantal facturen per pagina
        $perPage = 25;

        // Huidige pagina ophalen, standaard pagina 1
        $page = $request->input('page', 1);

        // Bereken de offset voor SQL-query (gebaseerd op paginering)
        $offset = ($page - 1) * $perPage;

        // Haal het totale aantal facturen op voor de paginering
        $total = DB::table('invoices')->count();

        try {
            // Log de oproep van de stored procedure voor debugging
            \Log::info("Oproep naar ReadInvoices met limit: $perPage en offset: $offset");

            // Roep de stored procedure aan om facturen op te halen
            $invoices = DB::select('CALL ReadInvoices(?, ?)', [$perPage, $offset]);

        } catch (\Exception $e) {
            // Log een foutmelding als de stored procedure mislukt
            \Log::error('Fout bij uitvoeren van ReadInvoices: ' . $e->getMessage());

            // Stuur de gebruiker terug met een foutmelding
            return redirect()->back()->with('error', 'Er is een probleem opgetreden bij het ophalen van facturen.');
            // $invoices = [];
        }

        // Maak een paginatie-object aan met de opgehaalde facturen
        $invoices = new LengthAwarePaginator(
            $invoices,
            $total,
            $perPage,
            $page,
            [
            'path' => $request->url(),
            'query' => $request->query(),
            ]
        );

        // Retourneer de facturen aan de bijbehorende Blade-view
        return view('invoices.index', ['invoices' => $invoices]);
    }

    /**
    * Show the form for creating a new invoices.
    */
    public function create()
    {
        // Haal de eerste beschikbare boeking op die nog geen factuur heeft
        $booking = Booking::whereDoesntHave('invoice')->first();
    
        // Controleer of er een beschikbare boeking is
        if (!$booking) {
            return redirect()->back()->with('error', 'Er zijn geen boekingen beschikbaar om een factuur voor aan te maken.');
        }
    
        return view('invoices.create', ['bookingId' => $booking->id]);
    }
    
    /**
     * Store a newly created invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = auth()->user();
    
        // Controleer of de gebruiker ingelogd is
        if (!$user) {
            return back()->withErrors(['EmployeeId' => 'Geen ingelogde gebruiker gevonden.']);
        }
    
        // Valideer de invoer van de gebruiker
        $data = $request->validate([
            'InvoiceNumber' => 'required|unique:invoices',
            'InvoiceDate' => 'required|date_format:d-m-Y',
            'AmountExclVAT' => 'required|numeric',
            'VAT' => 'required|numeric',
            'AmountIncVAT' => 'required|numeric',
            'InvoiceStatus' => 'required|string',
        ]);
        
        // Vul de ID's automatisch in
        $data['EmployeeId'] = $user->id; // Bijv. de ingelogde gebruiker als EmployeeId
        $data['BookingId'] = $request->input('BookingId');
    
        try {
            // Zorg ervoor dat de datum goed geparsed wordt en in de juiste indeling wordt opgeslagen
            $data['InvoiceDate'] = Carbon::createFromFormat('d-m-Y', $data['InvoiceDate'])->format('d-m-Y');
    
            // Maak de factuur aan
            Invoice::create($data);
    
            // Redirect naar de indexpagina met een succesmelding
            return redirect(route('invoices.index'))->with('success', 'De factuur is succesvol aangemaakt.');
        } catch (\Exception $e) {
            // Log de foutmelding voor debugging
            Log::error('Fout bij het opslaan van de factuur: ' . $e->getMessage(), [
                'data' => $data,
                'exception' => $e,
            ]);
    
            // Toon een foutmelding aan de gebruiker
            return back()->withErrors(['error' => 'Fout bij het opslaan van de factuur: ' . $e->getMessage()]);
        }
    }
}