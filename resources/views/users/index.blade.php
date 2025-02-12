<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Account overzicht
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        <table class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-gray-600 dark:text-gray-400 tracking-wider">Gebruikersnaam</th>
                    <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-gray-600 dark:text-gray-400 tracking-wider">Aangemaakt</th>
                    <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-gray-600 dark:text-gray-400 tracking-wider">Wijzigen</th>
                    <th class="px-4 py-2 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-gray-600 dark:text-gray-400 tracking-wider">Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-white dark:bg-gray-800">
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white">{{ $user->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white">{{ $user->created_at }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white"><a href="" class="bg-red-700 p-1 rounded">Verwijderen</a></td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white"><a href="">Wijzigen</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

{{$users->links() }}


</x-app-layout>