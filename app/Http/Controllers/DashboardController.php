<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends BaseController
{
    /**
     * Show the dashboard
     */
    public function index()
    {

        //Log::info('Dashboard access - Auth check: ' . (Auth::check() ? 'true' : 'false'));
        //Log::info('Dashboard access - Session ID: ' . session()->getId());
        //Log::info('Dashboard access - User: ' . (Auth::user() ? Auth::user()->username : 'null'));


        //dd(Auth::user());

        //return view('dashboard');

        // Ensure user is authenticated
        /*$user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }*/


        $customersCount = Customer::count() ?? 0;
        $latestCustomers = Customer::latest()->take(5)->get() ?? [];
        $partnerBanksCount = 0; // Hardcoded for now
        $activeBusinessCount = 0; // Hardcoded for now
        $openQueriesCount = 0; // Hardcoded for now

        return view('dashboard', [
                    'user' => $this->user,
                    'customersCount' => $customersCount,
                    'latestCustomers' => $latestCustomers,
                    'partnerBanksCount' => $partnerBanksCount,
                    'activeBusinessCount' => $activeBusinessCount,
                    'openQueriesCount' => $openQueriesCount,
                ]);


    }
}
