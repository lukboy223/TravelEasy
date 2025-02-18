{{-- layout --}}
<x-app-layout>

    {{-- title on the top of the screen --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Account toevoegen
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        <form action="{{ route('users.store') }} " method="post"
            class="w-3/4 bg-white dark:bg-gray-800 m-auto mt-5 mb-5 p-5 rounded shadow-md">
            @method('POST')
            @csrf
            <input type="text" name="FirstName" id="FirstName" placeholder="Voornaam" value="{{ old('FirstName') }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2" required>
            @error('FirstName')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="Infix" id="Infix" placeholder="Tussenvoegsel" value="{{ old('Infix') }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2">
            @error('Infix')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="LastName" id="LastName" placeholder="Achternaam" value="{{ old('LastName') }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700" required>
            @error('LastName')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <div class="w-full bg-black h-1 my-3"></div>
            <input type="text" name="Username" id="Username" placeholder="Gebruikersnaam" value="{{ old('Username') }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2" required>
            @error('Username')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="email" name="Email" id="Email" placeholder="Email"  value="{{ old('Email') }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2" required>
            @error('Email')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="password" name="Password" id="Password" placeholder="Wachtwoord" value="{{ old('Password') }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2" required>
            @error('Password')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="password" name="PasswordRepeat" id="PasswordRepeat" placeholder="Wachtwoord herhaal" value="{{ old('PasswordRepeat') }}"
                class="w-full p-2 rounded border border-gray-300 dark:border-gray-700" required>
            @error('PasswordRepeat')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <div class="w-full bg-black h-1 my-3"></div>
            <select name="role" id="role" class="w-full p-2 rounded border border-gray-300 dark:border-gray-700 mb-2"
                required>
                <option value="nothing" selected>Selecteer een rol</option>
                <option value="1">Gebruiker</option>
                <option value="2">Admin</option>
            </select>
            <button type="submit"
                class="bg-green-700 text-white p-2 rounded hover:bg-green-800 dark:hover:bg-green-900">Opslaan</button>
        </form>
        <?php var_dump($errors) ?>

        <div class="w-full justify-center flex my-6">
            {{-- button to create a new user --}}
            <a href="{{ route('users.index') }}"
                class="bg-blue-700 text-white p-2 rounded hover:bg-blue-800 dark:hover:bg-blue-900">Terug naar
                overzicht</a>

        </div>
    </div>



</x-app-layout>