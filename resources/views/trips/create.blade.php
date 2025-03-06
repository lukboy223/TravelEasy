<x-app-layout>
<body class="bg-gray-100 text-gray-900">

<!-- Centraal uitgelijnd formulier -->
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-[#5F1A37] mb-6">Nieuwe reis toevoegen</h1>

        <!-- Toont validatiefouten, indien aanwezig -->
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('trips.store') }}" class="space-y-4">
            @csrf
            @method('post')

            <!-- Verborgen velden voor DepartureId en DestinationId -->
            <input type="hidden" name="EmployeeId" value="{{ auth()->user()->id }}">
            <input type="hidden" name="DepartureId" value="{{ $departureId }}">
            <input type="hidden" name="DestinationId" value="{{ $destinationId }}">

            <!-- Startdatum -->
            <div class="flex flex-col">
                <label for="FlightNumber" class="font-semibold text-lg">Vluchtnummer</label>
                <input type="text" name="FlightNumber" id="FlightNumber" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>

            <!-- Einddatum -->
            <div class="flex flex-col">
                <label for="DepartureDate" class="font-semibold text-lg">Vertrekdatum</label>
                <input type="date" name="DepartureDate" id="DepartureDate" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>

            <!-- Starttijd -->
            <div class="flex flex-col">
                <label for="DepartureTime" class="font-semibold text-lg">Vertrektijd</label>
                <input type="time" name="DepartureTime" id="DepartureTime" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>

            <!-- Eindtijd -->
            <div class="flex flex-col">
                <label for="ArrivalDate" class="font-semibold text-lg">Aankomstdatum</label>
                <input type="date" name="ArrivalDate" id="ArrivalDate" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>        
            
            <!-- Eindtijd -->
            <div class="flex flex-col">
                <label for="ArrivalTime" class="font-semibold text-lg">Aankomsttijd</label>
                <input type="time" name="ArrivalTime" id="ArrivalTime" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
            </div>

            <!-- Status veld -->
            <div class="flex flex-col">
                <label for="TravelStatus" class="font-semibold text-lg">Reisstatus</label>
                <select name="TravelStatus" id="TravelStatus" required class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
                    <option value="">Selecteer een status</option>
                    <option value="Gepland">Gepland</option>
                    <option value="Onderweg">Onderweg</option>
                    <option value="Aangekomen">Aangekomen</option>
                    <option value="Geannuleerd">Geannuleerd</option>
                </select>
            </div>

            <!-- Verborgen velden voor automatisch invullen van ID's -->
           <!-- <input type="hidden" name="EmployeeId" value="{{ auth()->user()->id }}"> --> <!-- Zet hier de logica voor de EmployeeId --> 

            <!-- Verzendknop -->
             <div class="flex justify-end mt-4">
            <div class="flex justify-end">
                <button type="submit"
                style="background-color: #001f3d;" 
                class="text-white px-6 py-2 rounded font-semibold shadow-md transition">
                    Opslaan
                </button>
            </div>
            </div>
        </form>
    </div>
</div>

</body>
</x-app-layout>