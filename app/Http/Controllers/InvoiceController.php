<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Invoice;
use App\Models\Booking;

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
        }

        // Maak een paginatie-object aan met de opgehaalde facturen
        $invoices = new LengthAwarePaginator($invoices, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        // Retourneer de facturen aan de bijbehorende Blade-view
        return view('invoices.index', compact('invoices'));
    }

    // CREATE
    public function create()
    {
        // Haal de boeking op door de id
        //$booking = Booking::findOrFail($bookingId);
    
        // Stuur de boeking, bestemming en vertrek naar de view
       // return view('invoice.create', compact('bookings'));
        return view('invoices.create', ['bookingId' => Booking::all()]);
    }
    
    
    public function store(Request $request)
    {
        // Validatie van de invoer
        $data = $request->validate([
            'InvoiceNumber' => 'required|string|max:50|min:2',
            'InvoiceDate' => 'required|date_format:Y-m-d',
            'AmountExclVAT' => 'required|numeric|min:0',
            'VAT' => 'required|numeric|min:0|max:100',
            'AmountIncVAT' => 'required|numeric|min:0',
            'InvoiceStatus' => 'required|string|min:2|max:50',
            'Note' => 'nullable|string|max:255',
            'IsActive' => 'nullable|boolean',
        ]);
    
        // Haal de klant-id op (bijv. van de ingelogde gebruiker)
        $customerId = auth()->user()->id; // Dit is afhankelijk van hoe je gebruikersbeheer hebt ingesteld
    
        // Zoek de laatste boeking van de klant
        $booking = DB::table('bookings')
                    ->where('customer_id', $customerId) // Als je een klant-id in je boekingentabel hebt
                    ->latest() // Haal de laatste boeking
                    ->first();
    
        // Als er geen boeking is voor deze klant, geef een foutmelding
        if (!$booking) {
            return redirect()->route('invoices.create')->with('error', 'Geen boeking gevonden voor deze klant.');
        }
    
        // Haal de BookingId op
        $BookingId = $booking->id;
    
        // Probeer de factuur in de database op te slaan
        try {
            DB::table('invoices')->insert([
                'InvoiceNumber' => $request->InvoiceNumber,
                'InvoiceDate' => $request->InvoiceDate,
                'AmountExclVAT' => $request->AmountExclVAT,
                'VAT' => $request->VAT,
                'AmountIncVAT' => $request->AmountIncVAT,
                'InvoiceStatus' => $request->InvoiceStatus,
                'BookingId' => $BookingId, // Vul automatisch de BookingId in
                'Note' => $request->Note,
                'IsActive' => $request->IsActive,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Log de fout en geef een foutmelding terug naar de gebruiker
            Log::error('Error creating invoice: ' . $e->getMessage());
            return redirect()->route('invoices.create')->with('error', 'Er is iets fout gegaan, probeer het later opnieuw.');
        }
    
        // Succesvolle insert, stuur de gebruiker terug naar de overzichtspagina
        return redirect()->route('invoices.index')->with('success', 'Factuur is aangemaakt.');
    }
}