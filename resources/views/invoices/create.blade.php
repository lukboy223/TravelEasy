<x-app-layout>
<body class="bg-gray-100 text-gray-900">

<!-- Centraal uitgelijnd formulier -->
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-[#5F1A37] mb-6">Nieuwe factuur maken</h1>

        <!-- Toont validatiefouten, indien aanwezig -->
        @if($errors->any())
        @dd($errors->all())  {{-- Debugging: toont de validatiefouten --}}
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('invoices.store') }}" class="space-y-4">
            @csrf
            @method('POST')

            <!-- Verborgen veld voor boekingid -->
            <input type="hidden" name="BookingId" value="{{ $bookingId }}">

            <!-- Vluchtnummer -->
            <div class="flex flex-col">
                <label for="InvoiceNumber" class="font-semibold text-lg">Factuurnummer</label>
                <input type="text" name="InvoiceNumber" id="InvoiceNumber" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>

            <!-- Vertrekdatum -->
            <div class="flex flex-col">
                <label for="InvoiceDate" class="font-semibold text-lg">Factuurdatum</label>
                <input type="date" name="InvoiceDate" id="InvoiceDate" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>

            <!-- Vertrektijd -->
            <div class="flex flex-col">
                <label for="AmountExclVAT" class="font-semibold text-lg">BedragExcBtw</label>
                <input type="number" name="AmountExclVAT" id="AmountExclVAT" min="0" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>

            <!-- Aankomstdatum -->
            <div class="flex flex-col">
                <label for="VAT" class="font-semibold text-lg">Btw</label>
                <input type="number" name="VAT" id="VAT" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>        

            <!-- Aankomsttijd -->
            <div class="flex flex-col">
                <label for="AmountIncVAT" class="font-semibold text-lg">BedragIncBtw</label>
                <input type="number" name="AmountIncVAT" id="AmountIncVAT" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>

            <!-- Reisstatus -->
            <div class="flex flex-col">
                <label for="InvoiceStatus" class="font-semibold text-lg">Factuurstatus</label>
                <select name="InvoiceStatus" id="InvoiceStatus" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
                    <option disabled selected="">Selecteer een status</option>
                    <option value="Niet betaald">Niet betaald</option>
                    <option value="Betaald">Betaald</option>
                    <option value="Geannuleerd">Geannuleerd</option>
                </select>
            </div>

            <!-- Verzendknop -->
            <div class="flex justify-end mt-4">
                <button type="submit" class="text-white px-6 py-2 rounded font-semibold shadow-md transition" style="background-color: #001f3d;">
                    Opslaan
                </button>
            </div>
        </form>
        <?php // var_dump($errors); ?>

        <!-- Knop naar de overzicht -->
        <div class="justify-end mb-4">
            <a href="{{ route('invoices.index') }}" 
            style="background-color: #001f3d;" 
            class="text-white px-6 py-2 rounded font-semibold shadow-md transition">
            Terug naar overzicht
            </a>
        </div>
    </div>
</div>

</body>
</x-app-layout>
