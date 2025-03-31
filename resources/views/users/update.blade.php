{{-- layout --}}
<x-app-layout>

    {{-- title on the top of the screen --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Account bijwerken
        </h2>
    </x-slot>

    @if (session('error'))

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-3/4 m-auto text-center my-6" role="alert">
        <h3 class="block sm:inline">{{ session('error') }}</h3>
       
    </div>
    @endif
    <div class="overflow-x-auto">
        <form action="{{ route('users.update') }} " method="post"
            class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5 p-5 rounded shadow-md just">
            @method('PATCH')
            @csrf
            <input type="hidden" name="UserId" value="{{ $user[0]->UserId }}">
            <input type="hidden" name="PeopleId" value="{{ $user[0]->PeopleId }}">
            <input type="hidden" name="RoleId" value="{{ $user[0]->RoleId }}">
            
            <label for="FirstName">Voornaam</label>
            <input type="text" name="FirstName" id="FirstName" placeholder="John" value="{{ old('FirstName', $user[0]->FirstName) }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2" required>
            @error('FirstName')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <label for="Infix">Tussenvoegsel</label>
            <input type="text" name="Infix" id="Infix" placeholder="Van" value="{{ old('Infix', $user[0]->Infix) }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2">
            @error('Infix')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <label for="LastName">Achternaam</label>
            <input type="text" name="LastName" id="LastName" placeholder="Doe" value="{{ old('LastName', $user[0]->LastName) }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700"required >
            @error('LastName')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <label for="BirthDate">Geboorte datum</label>
            <input type="date" name="BirthDate" id="BirthDate" value="{{ old('BirthDate', $user[0]->BirthDate) }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2" required>
            @error('BirthDate')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <div class="w-full bg-black h-1 my-3"></div>
            <label for="Name">Gebruikersnaam</label>
            <input type="text" name="Name" id="Name" placeholder="JohnDoe14" value="{{ old('Name', $user[0]->Username) }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2" required>
            @error('Name')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" placeholder="Email@mail.com"  value="{{ old('Email', $user[0]->Email) }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2" required>
            @error('Email')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            
            <select name="Role" id="Role" class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2"
                required>
                <option value="nothing" selected>Selecteer een rol</option>
                <option value="Gebruiker">Gebruiker</option>
                <option value="Administrator">Administrator</option>
            </select>
            @error('Role')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <button type="submit"
                class="bg-green-700 text-white p-2 rounded hover:bg-green-800 dark:hover:bg-green-900">bijwerken</button>
        </form>

        <div class="w-full justify-center flex my-6">
            {{-- button to create a new user --}}
            <a href="{{ route('users.index') }}"
                class="bg-blue-700 text-white p-2 rounded hover:bg-blue-800 dark:hover:bg-blue-900">Terug naar
                overzicht</a>

        </div>
    </div>



</x-app-layout>