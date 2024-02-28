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
    $validated = $request->validate([
        'genre' => 'required',
    ]);

    if (Genre::where('name', $validated['genre'])->exists()) {
        return back()->with([
            'message' => 'Another genre name already exists with this name.',
            'operationSuccessful' => $this->operationSuccessful,
        ]);
    }

    Genre::create([
        'name' => $request->genre,
    ]);

    return back()->with([
        'message' => 'Genre created successfully!',
        'operationSuccessful' => $this->operationSuccessful = true,
    ]);

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
    if (Genre::where('name', $validatedData['name'])->where('id', '!=', $genre->id)->exists()) {
        return back()->with([
            'message' => 'Another genre name already exists with this name.',
            'operationSuccessful' => $this->operationSuccessful,
        ]);
    }
    $genre->update($validatedData);

    return back()->with([
        'message' => 'Genre updated successfully!',
        'operationSuccessful' => $this->operationSuccessful = true,
    ]);
}

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {

        $genre->delete();
        return back()->with([
            'message' => 'Genre deleted successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);


    }
}
