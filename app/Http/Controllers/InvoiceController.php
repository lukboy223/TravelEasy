<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Invoice;

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
}