<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
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
            'FirstName' => ['required', 'string', 'max:50', 'min:2', "regex:/^[a-zA-Z]+$/"],
            'Infix' => ['nullable', 'string', 'max:10', "regex:/^[a-zA-Z]+$/"],
            'LastName' => ['required', 'string', 'max:50', 'min:2', "regex:/^[a-zA-Z]+$/"],
            'BirthDate' => ['required', 'date', 'before:today', 'after:1900-01-01'],
            'Email' => ['required', 'email', 'unique:users,email'],
            'Username' => ['required', 'string', 'min:2', 'max:50', 'unique:users,name', "regex:/^[a-zA-Z]+$/"],
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
        $password = Hash::make($request->Password);

        //try catch to create the user
        try {
            DB::select('call CreateUser(?, ?, ?, ?, ?, ?, ?, ?)', [$request->FirstName, $Infix, $request->LastName, $request->BirthDate, $request->Email, $request->Username, $password, $request->Role]);
        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error creating user: ' . $e->getMessage());

            //redirects the user to the create page with an error message
            return redirect()->route('users.create')->with('error', 'Er is iets fout gegaan, probeer het later opnieuw.');
        }
        //sends the user back to the overview if the user is created
        return redirect()->route('users.index')->with('success', 'Gebruiker is aangemaakt.');
    }

    public function edit($userId)
    {
        try{
            $user = DB::select('call ReadUser(?)', [$userId]);
        }catch (\Exception $e){
            Log::error('error reading user: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'Geen user gevonden met dit ID.');
        }
        // dd($user);
        //redirect the user to the edit page with the user data
        return view('users.update', ['user' => $user]);
    }
    public function update(Request $request){

    
        $request->validate([
            'FirstName' => ['required', 'string', 'max:50', 'min:2', "regex:/^[a-zA-Z]+$/"],
            'Infix' => ['nullable', 'string', 'max:10', "regex:/^[a-zA-Z]+$/"],
            'LastName' => ['required', 'string', 'max:50', 'min:2', "regex:/^[a-zA-Z]+$/"],
            'BirthDate' => ['required', 'date', 'before:today', 'after:1900-01-01'],
            'Email' => ['required', 'email', Rule::unique('users')->ignore($request->UserId)],
            'Name' => ['required', 'string', 'min:2', 'max:50', Rule::unique('users')->ignore($request->UserId), "regex:/^[a-zA-Z]+$/"],
            'Role' => ['required', 'string', 'in:Gebruiker,Administrator']
        ]);
        

        //if infix is empty, set it to an empty string
        if ($request->Infix == null) {
            $Infix = '';
        }else{
            $Infix = $request->Infix;
        }
        try{
            DB::select('call UpdateUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->FirstName, $Infix, $request->LastName, $request->BirthDate, $request->Email, $request->Name, $request->Role , $request->PeopleId, $request->UserId, $request->RoleId]);
            return redirect()->route('users.index')->with('success', 'Gebruiker is aangepast.');
        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error updating user: ' . $e->getMessage());
            //redirects the user to the edit page with an error message
            return redirect()->route('users.edit', ['user' => $request->UserId])->with('error', 'Er is iets fout gegaan, probeer het later opnieuw.');
        }

    }
    public function destroy($userId){
        try{
            DB::select('call DeleteUser(?)', [$userId]);
            return redirect()->route('users.index')->with('success', 'Gebruiker is verwijderd.');
        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error deleting user: ' . $e->getMessage());
            //redirects the user to the index page with an error message
            return redirect()->route('users.index')->with('error', 'Er is iets fout gegaan, probeer het later opnieuw.');
        }
    }
}
