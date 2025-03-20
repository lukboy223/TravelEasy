<x-app-layout>

    <body class="bg-gray-100 text-gray-900">

        <!-- Centraal uitgelijnd formulier -->
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-center text-[#5F1A37] mb-6">Nieuwe Klant toevoegen</h1>

                <!-- Toont validatiefouten, indien aanwezig -->
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('customers.store') }}" class="space-y-4">
                    @csrf
                    @method('post')


                    <!-- Name veld -->
                    <div class="flex flex-col">
                        <label for="Firstname" class="font-semibold text-lg">Voornaam</label>
                        <input type="text" name="Firstname" id="Firstname" value="{{ old('Firstname') }}" 
                            class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
                    </div>

                    <!-- Einddatum -->
                    <div class="flex flex-col">
                        <label for="Infix" class="font-semibold text-lg">Tussenvoegsel</label>
                        <input type="text" name="Infix" id="Infix" value="{{ old('Infix') }}"
                            class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
                    </div>

                    <!-- Starttijd -->
                    <div class="flex flex-col">
                        <label for="Lastname" class="font-semibold text-lg">Achternaam</label>
                        <input type="text" name="Lastname" id="Lastname" value="{{ old('Lastname') }}" 
                            class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
                    </div>

                    <!-- Eindtijd -->
                    <div class="flex flex-col">
                        <label for="Birthdate" class="font-semibold text-lg">Geboortedatum</label>
                        <input type="date" name="Birthdate" id="Birthdate" value="{{ old('Birthdate') }}"
                            class="mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5F1A37] focus:border-transparent">
                    </div>


                    <!-- Terms of Service Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" name="Terms" id="Terms" class="mr-2">
                        <label for="Terms" class="font-semibold text-lg">Ik ga akkoord met de <a href="#"
                                class="text-[#5F1A37] underline">algemene voorwaarden</a></label>
                    </div>

                    <!-- Verborgen velden voor automatisch invullen van ID's -->
                    <!-- <input type="hidden" name="EmployeeId" value="{{ auth()->user()->id }}"> -->
                    <!-- Zet hier de logica voor de EmployeeId -->

                    <!-- Verzendknop -->
                    <div class="flex justify-end mt-4">
                        <div class="flex justify-end">
                            <button type="submit" style="background-color: #001f3d;"
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
