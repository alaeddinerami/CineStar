<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::with('image')->get();
        // dd($actors);
        return view('dashboard.actors.index',compact('actors'));
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
        $validationData = $request->validate([
            'nameactor' => "required"
        ]);
        $actor = Actor::create(
            [
                "name"=> $validationData["nameactor"],
            ]
        );

        $image = $this->storeImg($request->file('image'), $actor);
        return redirect()->back()->with([
            'message' => 'Hall created successfully!',
            'operationSuccessful' => $this->operationSuccessful = true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Actor $actor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor)
    {
        //
        $validationData = $request->validate([
            'name'=> 'required'
        ]);

        if ($request->hasFile('image')) {
            // dd($request->image);
            $image = $this->storeImg($request->file('image'), $actor);
            $this->upadateImg($request->file('image'), $actor);
        }
   

        $actor->update($validationData);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        //
        $actor->Delete();

        return redirect()->back()->with('success', 'Actor deleted successfully!');
    }
}
