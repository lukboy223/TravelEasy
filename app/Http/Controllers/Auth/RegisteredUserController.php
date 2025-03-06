<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //validate the request
        $request->validate([
            'FirstName' => ['required', 'string', 'max:50', 'min:2'],
            'Infix' => ['nullable', 'string', 'max:10'],
            'LastName' => ['required', 'string', 'max:50', 'min:2'],
            'BirthDate' => ['required', 'date', 'before:today', 'after:1900-01-01'],
            'Email' => ['required', 'email', 'unique:users,email'],
            'Username' => ['required', 'string', 'min:2', 'max:50', 'unique:users,name'],
            'Password' => ['required', 'min:8', 'max:255', Rules\Password::defaults()],
            'PasswordRepeat' => ['required', 'same:Password'],
        ]);
        //if infix is empty, set it to an empty string
        if ($request->Infix == null) {
            $Infix = '';
        } else {
            $Infix = $request->Infix;
        }
        //hash the password
        $password = Hash::make($request->Password);


        //try catch to create the user
        try {
            DB::select('call CreateUser(?, ?, ?, ?, ?, ?, ?, ?)', [$request->FirstName, $Infix, $request->LastName, $request->BirthDate, $request->Email, $request->Username, $password, 'Gebruiker']);
            $user = User::where('email', $request->Email)->firstOrFail();
        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error registering user: ' . $e->getMessage());
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
