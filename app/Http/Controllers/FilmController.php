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
        $films = Film::with('actors', 'genres', 'image')->get();
        $genres = Genre::all();
        $actors = Actor::all();
        return view('dashboard.films.index', compact('films', 'genres', 'actors'));
    }

    public function all(Request $request)
    {

        $films = Film::with('image');
    
        $search = $request->input('search');
        if ($search) {
            $films = $films->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('genres', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        }
        $films = $films->paginate(4);
        
        return view('films.index', compact('films'));
}
    

//     public function search(Request $request)
// {
    
    
//     return view('films.index', compact('filmss'));
// }

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
            'title' => 'required',
            'overview' => 'required',
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

        return redirect()->back()->with([
            'message' => 'Hall created successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        $now = now()->toDateTimeString();
        $film->load(['halls' => function ($query) use ($now) {
            $query->where('date', '>', $now)->withPivot('date');
        }]);
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $genres = Genre::all();
        $actors = Actor::all();
        dump($actors);
        dump($genres);
        return view('/dashboard/films', compact('film', 'genres', 'actors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'overview' => 'required',
        ]);
        if (Film::where('title', $validatedData['title'])->where('id', '!=', $film->id)->exists()) {
            return back()->with([
                'message' => 'Another film name already exists with this name.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }
        $film->update($validatedData);

        $genres = $request['genres'];
        $film->genres()->sync($genres);

        $actors = $request['actors'];
        $film->actors()->sync($actors);

        if ($request->hasFile('image')) {
            $this->storeImg($request->file('image'), $film);
            $this->upadateImg($request->file('image'), $film);
        }

        return back()->with([
            'message' => 'Genre updated successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->Delete();
        return back()->with([
            'message' => 'Film deleted successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }
}
