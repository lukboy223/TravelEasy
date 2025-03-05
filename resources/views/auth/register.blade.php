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
            <x-input-label for="LastName" :value="__('Achternaam')" />
            <x-text-input id="LastName" class="block mt-1 w-full" type="text" name="LastName" :value="old('LastName')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('LastName')" class="mt-2" />
            </div>
            <!-- BirthDate -->
            <div>
                <x-input-label for="BirthDate" :value="__('Geboorte datum')" />
                <x-text-input id="BirthDate" class="block mt-1 w-full" type="date" name="BirthDate" :value="old('BirthDate')" required autofocus autocomplete="date" />
                <x-input-error :messages="$errors->get('BirthDate')" class="mt-2" />
                </div>
                
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="Email" :value="__('Email')" />
                    <x-text-input id="Email" class="block mt-1 w-full" type="Email" name="Email" :value="old('Email')" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('Email')" class="mt-2" />
                    </div>
                    
                    <!-- Username -->
                    <div>
                        <x-input-label for="Username" :value="__('Gebruikersnaam')" />
                        <x-text-input id="Username" class="block mt-1 w-full" type="text" name="Username" :value="old('Username')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('Username')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="Password" :value="__('Wachtwoord')" />

                        <x-text-input id="Password" class="block mt-1 w-full"
                            type="password"
                            name="Password"
                            required autocomplete="new-password" />
                            
                            <x-input-error :messages="$errors->get('Password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="PasswordRepeat" :value="__('Herhaal wachtwoord')" />
            
            <x-text-input id="PasswordRepeat" class="block mt-1 w-full"
            type="password"
            name="PasswordRepeat" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('PasswordRepeat')" class="mt-2" />
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
