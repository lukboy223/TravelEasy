{{-- layout --}}
<x-app-layout>

    {{-- title on the top of the screen --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Account overzicht
        </h2>
    </x-slot>


    @if (session('success'))

    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-3/4 m-auto text-center my-6"
        role="alert">
        <h3 class="block sm:inline">{{ session('success') }}</h3>

    </div>
    @elseif (session('error'))

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-3/4 m-auto text-center my-6" role="alert">
        <h3 class="block sm:inline">{{ session('error') }}</h3>
       
    </div>
    @endif

    <div class="w-full justify-center flex my-3">
        {{-- button to create a new user --}}
        <a href="{{ route('users.create') }}"
            class="bg-blue-700 text-white p-2 rounded hover:bg-blue-800 dark:hover:bg-blue-900">Nieuwe
            account</a>

    </div>
    <div class="overflow-x-auto">
        <table class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5">
            <thead>
                <tr>
                    <th
                        class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4  tracking-wider">
                        Gebruikersnaam</th>
                    <th
                        class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                        Rol</th>
                    <th
                        class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                        Aangemaakt</th>
                    <th
                        class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                        Wijzigen</th>
                    <th
                        class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                        Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                {{-- if statement that checks if the array is empty and gives an message to the user if it is--}}
                @if($users->isEmpty())
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white bg-red-700 text-center"
                        colspan="5">Geen
                        resultaten gevonden, probeer het later opnieuw.</td>
                </tr>
                @else
                {{-- shows the data of the given array --}}
                @foreach($users as $user)
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700  border-r">{{ $user->Username }}
                    </td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700  border-r">{{ $user->RoleName }}
                    </td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700  border-r">{{ $user->created_at
                        }}</td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white border-r"><a
                            href="{{ route('users.edit', $user->UserId) }}"
                            class="bg-green-700 p-1 rounded">Wijzigen</a></td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white"><button type="button" class="bg-red-700 p-1 rounded"
                        onclick="showDeleteModal({{ $user->UserId }})">Verwijder</button></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="m-auto mt-5 mb-5 w-3/4">
            {{-- pagination buttons --}}
            {{$users->links() }}
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300">Verwijder gebruiker</h2>
            <p class="my-4 text-gray-500 dark:text-gray-400">Weet je zeker dat je deze gebruiker wil verwijderen?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="mt-6 px-4 py-2 bg-gray-600 text-white rounded-lg"
                    onclick="hideDeleteModal()">Cancel</button>
                <button type="submit" class="mt-6 px-4 py-2 bg-red-600 text-white rounded-lg">Verwijder</button>
            </form>
        </div>
    </div>


    <!-- Script to show and hide the delete modal -->
    <script>
        function showDeleteModal(id) {
        var action = '{{ route('users.destroy', ':id') }}';
        action = action.replace(':id', id);
        document.getElementById('deleteForm').action = action;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    
    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
    
    // Hide success message after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    });
    
    // Client-side validation
        function validateForm() {
            var isValid = true;
            
            var destination = document.getElementById('destination').value;
            var purchaseDate = document.getElementById('purchase_date').value;
            
            var destinationError = document.getElementById('destinationError');
            var purchaseDateError = document.getElementById('purchaseDateError');
            
            if (destination === '') {
                destinationError.classList.remove('hidden');
                isValid = false;
            } else {
                destinationError.classList.add('hidden');
            }
            
            if (purchaseDate === '') {
                purchaseDateError.classList.remove('hidden');
                isValid = false;
            } else {
                purchaseDateError.classList.add('hidden');
            }
            
            return isValid;
        }
    </script>
</x-app-layout>