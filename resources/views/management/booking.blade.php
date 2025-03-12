{{-- layout --}}
<x-app-layout>

    {{-- title on the top of the screen --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aantal boekingen per dag
        </h2>
    </x-slot>


    @if (session('success'))

    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-3/4 m-auto text-center my-6"
        role="alert">
        <h3 class="block sm:inline">{{ session('success') }}</h3>

    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5">
            <thead>
                <tr>

                    <th
                        class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                        Datum</th>
                    <th
                        class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                        Aantal boekingen</th>

                </tr>
            </thead>
            <tbody>
                {{-- if statement that checks if the array is empty and gives an message to the user if it is--}}
                @if($Bookings->isEmpty())
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white bg-red-700 text-center"
                        colspan="5">Geen
                        resultaten gevonden, probeer het later opnieuw.</td>
                </tr>
                @else
                {{-- shows the data of the given array --}}
                @foreach($Bookings as $Booking)
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700  border-r">{{ $Booking->Purchase_date }}
                    </td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700  border-r">{{ $Booking->total }}
                    </td>
                    @endforeach
                    @endif
            </tbody>
        </table>
        <div class="m-auto mt-5 mb-5 w-3/4">
            {{-- pagination buttons --}}
            {{$Bookings->links() }}
        </div>
    </div>



</x-app-layout>