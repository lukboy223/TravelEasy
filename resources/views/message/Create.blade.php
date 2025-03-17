<x-app-layout>
{{-- title on the top of the screen --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Account toevoegen
        </h2>
    </x-slot>

    @if (session('error'))

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-3/4 m-auto text-center my-6" role="alert">
        <h3 class="block sm:inline">{{ session('error') }}</h3>
       
    </div>
    @endif

        <div class="overflow-x-auto">
        <form action="{{ route('users.store') }} " method="post"
            class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5 p-5 rounded shadow-md just">
            @method('POST')
                @csrf

                    <label for="customer_fullname">klant naam</label>
                    <input type="text" id="customer_fullname" name="customer_fullname" placeholder="john doe" value="{{ old('customer_fullname') }}"
                           class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2">      
                    @error('customer_fullname')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label for="employee_fullname">medewerker naam</label>
                    <input type="text" id="employee_fullname" name="employee_fullname" placeholder="john doe" value="{{ old('employee_fullname') }}"
                           class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2">
                    @error('employee_fullname')
                    <p class="text-red-500">{{ $message }}</p>    
                    @enderror

                    <label for="messageverzendatum">Vertrekdatum</label>
                    <input type="date" id="messageverzendatum" name="messageverzendatum" value="{{ old('messageverzendatum') }}"
                           class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2">
                    @error('messageverzendatum')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label for="messagevluchtnumber">Vluchtnummer</label>
                    <input type="text" id="messagevluchtnumber" name="messagevluchtnumber" placeholder="1234567890" value="{{ old('messagevluchtnumber') }}"
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

</x-app-layout>