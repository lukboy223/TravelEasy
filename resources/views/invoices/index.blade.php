<x-app-layout>
<body class="bg-gray-100 text-white-800">
    <div class="container mx-auto py-8">
        <h1 class="text-bordeaux text-2xl font-bold text-center mb-6">Overzicht Facturen</h1>

        <!-- Bericht weergeven als een sessie een 'success'-bericht bevat -->
        @if(session()->has('success'))
            <div class="bg-green-100 text-green-800 border border-green-200 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel met alle reizen -->
        <div class="overflow-x-auto mx-auto max-w-6xl">
        <!-- Link om een nieuwe reis te creëren -->
        <div class="justify-end mb-4">
            <a href="{{ route('invoices.create') }}" 
            style="background-color: #001f3d;" 
            class="text-white px-6 py-2 rounded font-semibold shadow-md transition">
            Nieuwe factuur maken
            </a>
        </div>
            <table class="table-auto w-full bg-white border-collapse border border-gray-200 shadow-md">
                <thead style="background-color: #001f3d;" class="text-white">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">Factuurnummer</th>
                        <th class="px-4 py-2 border border-gray-300">Factuurdatum</th>
                        <th class="px-4 py-2 border border-gray-300">BedragExcBtw</th>
                        <th class="px-4 py-2 border border-gray-300">Btw</th>
                        <th class="px-4 py-2 border border-gray-300">BedragIncBtw</th>
                        <th class="px-4 py-2 border border-gray-300">Factuurtatus</th>
                    </tr>
                </thead>
                <tbody>
                    @if($invoices->isEmpty())
                        <tr>
                            <td class="px-4 py-2 border border-gray-300 text-center bg-blue-100 align-middle h-16" colspan="8">Geen data gevonden, probeer het later opnieuw</td>
                        </tr>
                    @else
                    @foreach($invoices as $invoice)
                        <tr class="text-center hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $invoice->InvoiceNumber }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $invoice->InvoiceDate }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $invoice->AmountExclVAT }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $invoice->VAT }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $invoice->AmountIncVAT }}</td>
                            <!-- Dynamische statuskleur hier -->
                            <td class="px-4 py-2 border border-gray-300 
                                @if($invoice->InvoiceStatus == 'Geannuleerd') 
                                    text-red-600 bg-red-100 
                                @elseif($invoice->InvoiceStatus == 'Betaald') 
                                    text-green-600 bg-green-99 
                                @elseif($invoice->InvoiceStatus == 'Niet betaald') 
                                    text-orange-600 bg-orange-100 
                                @else 
                                    text-gray-600 bg-gray-100 
                                @endif">
                                {{ $invoice->InvoiceStatus }}
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
                <!-- Knop naar homepage -->
                <div class="flex justify-end mt-4">
                <a href="/"
                    style="background-color: #001f3d;" 
                    class="text-white px-6 py-2 rounded font-semibold shadow-md transition">Home pagina</a>
                </div>
            <!-- Paginatie Links -->
            <div class="mt-6">
                {{ $invoices->links() }}
            </div>
    </div>
    </div>
</x-app-layout>