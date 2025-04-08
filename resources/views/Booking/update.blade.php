<!-- filepath: c:\Users\solap\Herd\Project p3\TravelEasy\resources\views\Booking\create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Booking
        </h2>
    </x-slot>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5 w-3/4 m-auto">
            {{ session('error') }}
        </div>
    @endif


    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('booking.update', $Booking[0]->id) }}">
            @method('PATCH')
            @csrf
            {{-- comnnects it to a view livewire --}}
            <label for="relation_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Relation
                Nummer</label>
            @livewire('SearchCustomer')


            <label for="FlightNumber" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Vlucht
                Nummer</label>
            @livewire('SearchTrip')


            <div class="mt-4">
                <label for="seat_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Seat
                    Number</label>
                <input id="seat_number" value="{{ old('seat_number', $Booking[0]->seat_number) }}"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="text"
                    name="seat_number" required />
            </div>

            <div class="mt-4">
                <label for="purchase_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Purchase
                    Date</label>
                <input id="purchase_date" value="{{ old('purchase_date', $Booking[0]->purchase_date) }}"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="date"
                    name="purchase_date" required />
            </div>

            <div class="mt-4">
                <label for="purchase_time" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Purchase
                    Time</label>
                <input id="purchase_time" value="{{ old('purchase_time', $Booking[0]->purchase_time) }}"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="time"
                    name="purchase_time" required />
            </div>

            <div class="mt-4">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                <input id="price" value="{{ old('price', $Booking[0]->price) }}"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="text"
                    name="price" required />
            </div>

            <div class="mt-4">
                <label for="quantity"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity</label>
                <input id="quantity" value="{{ old('quantity', $Booking[0]->quantity) }}"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="text"
                    name="quantity" required />
            </div>

            <div class="mt-4">
                <label for="booking_status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Booking
                    Status</label>
                <select id="booking_status" name="booking_status"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" required>
                    <option value="confirmed">Confirmed</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="ml-4 px-4 py-2 bg-green-500 text-white rounded-md">Wijzigen</button>
            </div>
        </form>
    </div>`


</x-app-layout>
