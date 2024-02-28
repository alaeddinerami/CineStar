<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Film;
use App\Models\Genre;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ImageUpload;
    public function index()
    {
        $films = Film::with('genres')->get();
        $genres = Genre::all();
        $actors = Actor::all();
        return view('dashboard.films.index', compact('films','genres','actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title'=> 'required',
            'overview'=> 'required',
        ]);
        
        $genres = $request['genres'];
        $actors = $request['actors'];
        array_shift($genres);
        array_shift($actors);
        // dd($validatedData['genres']);
        $newfilm = Film::create($validatedData);
        $newfilm->genres()->attach($genres);
        $newfilm->actors()->attach($actors);

        $this->storeImg($request->file('image'), $newfilm);
        
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        //
        $film->Delete();

        return redirect()->back();
    }
}
