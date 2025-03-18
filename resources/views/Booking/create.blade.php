<!-- filepath: c:\Users\solap\Herd\Project p3\TravelEasy\resources\views\Booking\create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Booking
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <div>
                <label for="relation_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Relation Number</label>
                <input id="relation_number" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="text" name="relation_number" required />
            </div>

            <div class="mt-4">
                <label for="destination" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Destination</label>
                <input id="destination" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="text" name="destination" required />
            </div>

            <div class="mt-4">
                <label for="seat_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Seat Number</label>
                <input id="seat_number" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="text" name="seat_number" required />
            </div>

            <div class="mt-4">
                <label for="purchase_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Purchase Date</label>
                <input id="purchase_date" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="date" name="purchase_date" required />
            </div>

            <div class="mt-4">
                <label for="purchase_time" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Purchase Time</label>
                <input id="purchase_time" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="time" name="purchase_time" required />
            </div>

            <div class="mt-4">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                <input id="price" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="text" name="price" required />
            </div>

            <div class="mt-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity</label>
                <input id="quantity" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" type="text" name="quantity" required />
            </div>

            <div class="mt-4">
                <label for="booking_status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Booking Status</label>
                <select id="booking_status" name="booking_status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" required>
                    <option value="confirmed">Confirmed</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="ml-4 px-4 py-2 bg-green-500 text-white rounded-md">Create</button>
            </div>
        </form>
    </div>
</x-app-layout>