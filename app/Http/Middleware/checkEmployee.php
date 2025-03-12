<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class checkEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
try{

    // gets the user id
    $userid = Auth::id();
    // gets the roles of the user
    $roles = DB::select('call ReadRoles(?)', [$userid]);
    
    foreach ($roles as $role) {
        //checks if the user is an administrator or employee
        if ($role->Name == 'Administrator' || $role->Name == 'Employee') {
            return $next($request);
            }
        }
    } catch (\Exception $e) {
        //logs the error in the log
        Log::error('error reading roles: ' . $e->getMessage());
    }
        return redirect('/');

    }
}
