<?php

namespace App\Http\Controllers;

use App\Models\Batalyon;
use App\Http\Requests\StoreBatalyonRequest;
use App\Http\Requests\UpdateBatalyonRequest;
use Illuminate\Http\Request;

class BatalyonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batalyons = Batalyon::all();
        return response()->json($batalyons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $batalyon = Batalyon::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Success',
            'data' => ($batalyon)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Batalyon $batalyon, $id)
    {
        $batalyon = Batalyon::findOrFail($id);
        return response()->json($batalyon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batalyon $batalyon, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $batalyon = Batalyon::findOrFail($id);
        $batalyon->update($request->all());

        return response()->json($batalyon);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batalyon $batalyon, $id)
    {
        $batalyon = Batalyon::findOrFail($id);
        $batalyon->delete();

        return response()->json([
            'message' => 'Data Batalyon Berhasil Dihapus',
            'data' => ($batalyon)
        ], 200);
    }
}
