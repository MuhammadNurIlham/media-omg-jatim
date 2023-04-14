<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Http\Resources\NewsDetailResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        return NewsDetailResource::collection($programs->loadMissing(['writer:id,name', 'kategori:id,name'])); // using API Resource
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program, $id)
    {
        $program = Program::with([
            'writer:id,name',
            'kategori:id,name'
        ])->findOrFail($id);
        return new NewsDetailResource($program); // using API Resource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $program = Program::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);

        return new NewsDetailResource($program->loadMissing(['writer:id,name', 'category:id,name']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $program = Program::findOrFail($id);
        $program->update($request->all());

        return new NewsDetailResource($program->loadMissing(['writer:id,name', 'category:id,name']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program, $id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        return [
            'message' => 'Data Program berhasil dihapus',
            'data' => new NewsDetailResource($program->loadMissing(['writer:id,name', 'category:id,name']))
        ];
    }
}
