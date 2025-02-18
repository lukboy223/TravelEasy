<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function store(Request $request)
    {
        //validate the request
        $request->validate([
            'FirstName' => 'required' , 'string',
            'LastName' => 'required', 'string',
            'Email' => 'required', 'email', 'Unique:'.User::class,
            'Username' => 'required', 'string', 'Unique:'.User::class,
            'Password' => 'required', Rules\Password::defaults(),
            'PasswordRepeat' => 'required', 'same:password',
        ]);

        //try catch looks if the SP exists
        try{
            DB::select('call CreateUser(?, ?, ?)', [$request->name, $request->email, $request->password]);

        } catch (\Exception $e) {
            //if the SP doesn't exist, redirect the user to the create page
            return redirect()->route('users.create');
        }

        //redirect the user to the index page with all the users
        return redirect()->route('users.index');

    }
}
