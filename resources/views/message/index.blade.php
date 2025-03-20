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
    <div class="justify-end flex my-6 w-3/4 m-auto">
        {{-- button to create a new message --}}
        <a href="{{ route('message.create') }}"
            class="bg-blue-700 text-white p-2 rounded hover:bg-blue-800 dark:hover:bg-blue-900">Nieuwe
            bericht</a>
    </div>

<div class="overflow-x-auto">
    <table class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5">

        <thead>
            <th class="px-4 py-2 border border-gray-300">klant naam</th>
            <th class="px-4 py-2 border border-gray-300">medewerker naam</th>
            <th class="px-4 py-2 border border-gray-300">verzendatum</th>
            <th class="px-4 py-2 border border-gray-300">Vluchtnummer</th>
            <th class="px-4 py-2 border border-gray-300">bericht</th>
            <th class="px-4 py-2 border border-gray-300">verzonden</th>ve
            <th class="px-4 py-2 border border-gray-300">Wijzigen</th>
            <th class="px-4 py-2 border border-gray-300">Verwijderen</th>
        </thead>
        <tbody>
        @if($messages->isEmpty())
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-white bg-red-700 text-center" colspan="7">
                        er is op dit moment een technische storing, probeer het later nog een keer.</td>
                </tr>
                @else
            @foreach($messages as $message)
                <tr>
                    <td class="px-4 py-2 border border-gray-300"> {{$message ->customer_fullname}}</td>
                    <td class="px-4 py-2 border border-gray-300"> {{$message ->employee_fullname}}</td>
                    <td class="px-4 py-2 border border-gray-300"> {{$message ->messageverzendatum}}</td>
                    <td class="px-4 py-2 border border-gray-300"> {{$message ->messagevluchtnumber}}</td>
                    <td class="px-4 py-2 border border-gray-300"> {{$message ->message}}</td>
                    <td class="px-4 py-2 border border-gray-300"> {{$message ->messageisactief}}</td>
                    <td class="px-4 py-2 border border-gray-300">
                        <a href="{{ route('message.edit', $message->MessageID) }}" class="bg-green-600 hover:bg-green-400 text-white font-bold py-2 px-4 rounded">Wijzigen</a>
                    </td>
                    <td class="px-4 py-2 border border-gray-300">
                        <form action="{{ route('message.destroy', $message->MessageID) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="m-auto mt-5 mb-5 w-3/4">
            {{-- pagination buttons --}}
            {{$messages->links() }}
        </div>

</div>
    </x-app-layout>