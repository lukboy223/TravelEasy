{{-- layout --}}
<x-app-layout>

    {{-- title on the top of the screen --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Account overzicht
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        <table class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5">
            <thead>
                <tr>
                    <th
                        class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 text-white tracking-wider">
                        Gebruikersnaam</th>
                    <th
                        class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 text-white tracking-wider">
                        Rol</th>
                    <th
                        class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 text-white tracking-wider">
                        Aangemaakt</th>
                    <th
                        class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 text-white tracking-wider">
                        Wijzigen</th>
                    <th
                        class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-white tracking-wider">
                        Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                {{-- if statement that checks if the array is empty and gives an message to the user if it is--}}
                @if($users->isEmpty())
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white bg-red-900 text-center" colspan="5">Geen
                        resultaten gevonden, probeer het later opnieuw.</td>
                </tr>
                @else
                {{-- shows the data of the given array --}}
                @foreach($users as $user)
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white border-r">{{ $user->Username }}
                    </td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white border-r">{{ $user->RoleName }}
                    </td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white border-r">{{ $user->created_at
                        }}</td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white border-r"><a href=""
                            class="bg-green-700 p-1 rounded">Wijzigen</a></td>
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white"><a href=""
                            class="bg-red-700 p-1 rounded">Verwijderen</a></td>
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



</x-app-layout>