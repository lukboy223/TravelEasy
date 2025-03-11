<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Berichten
        </h2>
    </x-slot>
    @if (session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-3/4 m-auto text-center my-6" role="alert">
    <h3 class="block sm:inline">{{ session('success') }}</h3>
   
</div>
@endif

<div class="overflow-x-auto">
    <table class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5">

        <thead>
            <th class="px-4 py-2 border border-gray-300">klant naam</th>
            <th class="px-4 py-2 border border-gray-300">medewerker naam</th>
            <th class="px-4 py-2 border border-gray-300">Vertrekdatum</th>
            <th class="px-4 py-2 border border-gray-300">Vluchtnummer</th>
            <th class="px-4 py-2 border border-gray-300">bericht</th>
            <th class="px-4 py-2 border border-gray-300">Wijzigen</th>
            <th class="px-4 py-2 border border-gray-300">Verwijderen</th>
        </thead>
        <tbody>
            @foreach($message as $message)
            <td class="px-4 py-2 border border-gray-300"> $message ->UserName</td>
            <td class="px-4 py-2 border border-gray-300"> $message ->UserName</td>
            <td class="px-4 py-2 border border-gray-300"> $message ->messageverzendatum</td>
            <td class="px-4 py-2 border border-gray-300"> $message ->messagevluchtnumber</td>
            <td class="px-4 py-2 border border-gray-300"> $message ->message</td>
            <td class="px-4 py-2 border border-gray-300">
                <a href="{{ route('message.edit', $message->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wijzigen</a>
            </td>
            <td class="px-4 py-2 border border-gray-300">
                <form action="{{ route('message.destroy', $message->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Verwijderen</button>
                </form>
            </td>
            @endforeach
        </tbody>
    </table>
</div>
    </x-app-layout>