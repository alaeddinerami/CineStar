<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.screenings.index");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $operationSuccessful = false;

        if ($operationSuccessful) {
            $message = "Screening reserved successfully!";
        } else {
            $message = "You can't reserve another movie on the same time.";
        }

        return back()->with([
            'message' => $message,
            'operationSuccessful' => $operationSuccessful,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('dashboard.screenings.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
