<x-app-layout>
{{-- title on the top of the screen --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            bericht toevoegen
        </h2>
    </x-slot>

    @if (session('error'))

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-3/4 m-auto text-center my-6" role="alert">
        <h3 class="block sm:inline">{{ session('error') }}</h3>
       
    </div>
    @endif

        <div class="overflow-x-auto">
        <form action="{{ route('message.store') }} " method="post"
            class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5 p-5 rounded shadow-md just">
            @method('POST')
                @csrf
                    <label>klantnaam</label>
                    @livewire('search-fullname-bericht')



                    <label for="messagevluchtnumber">Vluchtnummer</label>
                    <input type="text" id="messagevluchtnumber" name="messagevluchtnumber" placeholder="123456" value="{{ old('messagevluchtnumber') }}"
                           class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2">
                    @error('messagevluchtnumber')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                
                    <label for="message">bericht</label>
                    <input type="text" id="message" name="message" placeholder="bericht" value="{{ old('message') }}"
                           class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2">
                    
                    @error('message')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror                     
                <button type="submit"     
                class="bg-green-700 text-white p-2 rounded hover:bg-green-600 dark:hover:bg-green-700">Opslaan</button>
        </form>

            <div class="w-full justify-center flex my-6">
                {{-- button to create a new message --}}
                <a href="{{ route('message.index') }}"
                    class="bg-blue-700 text-white p-2 rounded hover:bg-blue-800 dark:hover:bg-blue-900">
                    Terug naar overzicht
                </a>
            </div>
    </div> 
    <script>
</script>
</x-app-layout>