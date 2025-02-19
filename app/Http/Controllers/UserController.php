<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
// use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    public function index(Request $request)
    {

        //makes variables for pagination

        $perPage = 25;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $total = DB::table('users')->count();

        // try catch looks if the SP exists
        try{
            $users = DB::select('call ReadUsers(?, ?)', [$perPage, $offset]);

        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error reading users: ' . $e->getMessage());
            //makes an empty array if the SP doesn't exist
            $users = [];
        }
        
        //paginate

        $users = new LengthAwarePaginator($users, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        //redirect the user to the index page with all the users
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        //redirect the user to the create page
        return view('users.create');
    }

    //creates rows in the database
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'FirstName' => ['required', 'string', 'max:50', 'min:2'],
            'Infix' => ['nullable', 'string', 'max:10'],
            'LastName' => ['required', 'string', 'max:50', 'min:2'],
            'BirthDate' => ['required', 'date', 'before:today', 'after:1900-01-01'],
            'Email' => ['required', 'email', 'unique:users,email'],
            'Username' => ['required', 'string', 'min:2', 'max:50', 'unique:users,name'],
            'Password' => ['required', 'min:8', 'max:255', Rules\Password::defaults()],
            'PasswordRepeat' => ['required', 'same:Password'],
            'Role' => ['required', 'string', 'in:Gebruiker,Administrator']
        ]);

        //if infix is empty, set it to an empty string
        if ($request->Infix == null) {
            $Infix = '';
        }else{
            $Infix = $request->Infix;
        }

        //try catch to create the user
        try {
            DB::select('call CreateUser(?, ?, ?, ?, ?, ?, ?, ?)', [$request->FirstName, $Infix, $request->LastName, $request->BirthDate, $request->Email, $request->Username, $request->Password, $request->Role]);
        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error creating user: ' . $e->getMessage());

            //redirects the user to the create page with an error message
            return redirect()->route('users.create')->with('error', 'Er is iets fout gegaan, probeer het later opnieuw.');
        }
        //sends the user back to the overview if the user is created
        return redirect()->route('users.index')->with('success', 'Gebruiker is aangemaakt.');
    }
}
