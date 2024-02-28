<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        return view('dashboard.genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $request->validate([
        'genre' => 'required',
    ]);
    Genre::create([
        'name' => $request->genre,
    ]);

    return redirect()->back()->with('sucesses');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
{
    $validatedData = $request->validate([
        'name' => 'required',
    ]);
    $genre->update($validatedData);

    return redirect()->back()->with('success');
}

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        
        return redirect()->back()->with('success', 'Actor deleted successfully!');

    }
}
