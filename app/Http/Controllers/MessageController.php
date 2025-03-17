<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\message;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;


class  MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $perPage = 25;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $total = DB::table('messages')->count();

        // try catch looks if the SP exists
        try{
            $messages = DB::select('CALL ReadMessages(?, ?)', [$perPage, $offset]);

        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error reading messages: ' . $e->getMessage());
            //makes an empty array if the SP doesn't exist
            $messages = [];
        }
        
        //paginate

        $messages = new LengthAwarePaginator($messages, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);


        return view('message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //redirect the user to the create page
        return view('message.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        //validate the input
        $request->validate([
            'customer_fullname' => 'required', 'string', 'max:110', 'min:4',
            'employee_fullname' => 'required', 'string', 'max:110', 'min:4',
            'messageverzendatum' => 'required', date('d-m-Y H:i:s'),
            'messagevluchtnumber' => 'required', 'string', 'max:10', 'min:10',
            'message' => 'required', 'string', 'max:255', 'min:4',

        ]);

        // try catch looks if the SP exists
        try{
            DB::select('CALL SP_CreateMessage(?, ?, ?, ?, ?, ?)', [
                $request->customer_id,
                $request->employee_id,
                $request->bericht,
                $request->verzonden_datum,
                $request->isactief,
                $request->opmerking,
            ]);
        } catch (\Exception $e) {
            //logs the error in the log
            Log::error('error creating message: ' . $e->getMessage());
        }

        return redirect()->route('message.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
