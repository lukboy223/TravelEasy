<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use App\Models\Person;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index(Request $request)
    {
        $perPage = 25;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $total = DB::table('customers')->count();

        // try catch looks if the SP exists
        try {
            $customers = DB::select('call SP_GetPeople(?, ?) ', [$perPage, $offset]);
        } catch (\Exception $e) {
            // logs the error in the log
            Log::error('error reading users: ' . $e->getMessage());
            // makes an empty array if the SP doesn't exist
            $customers = [];
        }

        // paginate
        $customers = new \Illuminate\Pagination\LengthAwarePaginator($customers, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),

        ]);

        // redirect the user to the index page with all the users
        return view('customers.index', ['customers' => $customers]);
    }
    public function create()
    {
        return view('customers.create');
        
    }
    public function store(Request $request)
    {
        

        $validatedData = $request->validate([
            'Firstname' => 'required|string|max:50|min:2|regex:/^[a-zA-Z]+$/',
            'Infix' => 'nullable|string|max:50|min:2|regex:/^[a-zA-Z]+$/',
            'Lastname' => 'required|string|max:50|min:2|regex:/^[a-zA-Z]+$/',
            'Birthdate' => 'required|date|before:today|after:1900-01-01', 
            'Terms' => 'required|accepted'
        ]);
        

        // dd("Ik ben voor new person hier");
        // Insert data into the people table
        $person = new Person();
        $person->Firstname = $validatedData['Firstname'];
        $person->Infix = $validatedData['Infix'];
        $person->Lastname = $validatedData['Lastname'];
        $person->Birthdate = $validatedData['Birthdate'];
        $person->save();

        // Associate the person record with the customers table
        $customer = new Customer();
        $customer->PeopleId = $person->id;
        // Generate a unique incremented number for RelationNumber
       
        $customer->RelationNumber = (string) ($person->id + 1000);
        

        $customer->save();



    
        return redirect()->route('customers.index')->with('success', 'Klant succesvol toegevoegd.');
    }
    

    public function search(Request $request)
    {
        $LastnameFilter = $request->input('Lastname');

        // call the stored procedure with filtering
        try {
            $customers = DB::select('CALL SP_GetPeopleFiltered(?, ?, ?)', [100, 0, $LastnameFilter]);
        } catch (\Exception $e) {
            // logs the error in the log
            Log::error('error reading customers: ' . $e->getMessage());
            // create an empty array if the SP doesn't exist
            $customers = [];
        }

        return response()->json($customers);
    }

    
}