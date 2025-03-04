<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Firstname -->
        <div>
            <x-input-label for="FirstName" :value="__('Voornaam')" />
            <x-text-input id="FirstName" class="block mt-1 w-full" type="text" name="FirstName" :value="old('FirstName')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('FirstName')" class="mt-2" />
        </div>
        <!-- Infix -->
        <div>
            <x-input-label for="Infix" :value="__('Tussenvoegsel')" />
            <x-text-input id="Infix" class="block mt-1 w-full" type="text" name="Infix" :value="old('Infix')"  autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('Infix')" class="mt-2" />
        </div>
        <!-- Lastname -->
        <div>
            <x-input-label for="Lastname" :value="__('Achternaam')" />
            <x-text-input id="Lastname" class="block mt-1 w-full" type="text" name="Lastname" :value="old('Lastname')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('Lastname')" class="mt-2" />
        </div>
        <!-- BirthDate -->
        <div>
            <x-input-label for="BirthDate" :value="__('Geboorte datum')" />
            <x-text-input id="BirthDate" class="block mt-1 w-full" type="datum" name="BirthDate" :value="old('BirthDate')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('BirthDate')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
