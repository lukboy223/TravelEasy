<!-- filepath: /c:/Users/solap/Herd/Project p3/TravelEasy/resources/views/Booking/index.blade.php -->
{{-- layout --}}
<x-app-layout>

    {{-- title on the top of the screen --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Account Overview
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        <div class="flex justify-center mt-5">
            <form method="GET" action="{{ route('booking.index') }}" class="flex space-x-4">
                <div>
                    {{-- this is where the filtering happens using request --}}
                    <label for="destination" class="block text-sm font-medium text-gray-700 dark:text-gray-200"><strong>Destination</strong></label>
                    <input type="text" name="destination" id="destination" value="{{ request('destination') }}"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="purchase_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200"><strong>Purchase Date</strong></label>
                    <input type="date" name="purchase_date" id="purchase_date" value="{{ request('purchase_date') }}"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Filter</button>
                </div>
            </form>
            {{-- this is the create new booking --}}
            <div class="flex items-end ml-4">
                <a href="{{ route('booking.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-md">Create Booking</a>
            </div>
        </div>
    </div>

    <table class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Relation Number</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Destination</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Seat Number</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Purchase Date</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Purchase Time</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Price</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Quantity</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Booking Status</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Edit</th>
                <th class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($paginatedBookings as $booking)
                <tr>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">{{ $booking->relation_number }}</td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">{{ $booking->destination }}</td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">{{ $booking->seat_number }}</td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">{{ $booking->purchase_date }}</td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">{{ $booking->purchase_time }}</td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">{{ $booking->price }}</td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">{{ $booking->quantity }}</td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">{{ $booking->booking_status }}</td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">
                        <a href="{{ route('booking.edit', $booking->id) }}" class="text-blue-500">Edit</a>
                    </td>
                    <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">
                        <button type="button" class="text-red-500" onclick="showDeleteModal({{ $booking->id }})">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700 text-center">
                        No bookings available
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="container m-auto">
        <div class="mt-4">
            {{ $paginatedBookings->links() }}
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300">Confirm Delete</h2>
            <p class="my-4 text-gray-500 dark:text-gray-400">Are you sure you want to delete this item?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="mt-6 px-4 py-2 bg-gray-600 text-white rounded-lg" onclick="hideDeleteModal()">Cancel</button>
                <button type="submit" class="mt-6 px-4 py-2 bg-red-600 text-white rounded-lg">Delete</button>
            </form>
        </div>
    </div>

    <!-- Script to show and hide the delete modal -->
    <script>
        function showDeleteModal(id) {
            var action = '{{ route('booking.destroy', ':id') }}';
            action = action.replace(':id', id);
            document.getElementById('deleteForm').action = action;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>

</x-app-layout>