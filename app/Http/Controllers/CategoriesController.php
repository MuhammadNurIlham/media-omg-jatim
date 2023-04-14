<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Categories::all();
        return response()->json($categories);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories, $id)
    {
        //
        $categories = Categories::findOrFail($id);
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Categories::create([
            'name' => $request->name,
            // 'user_id' => Auth::user()->id,
        ]);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $categories = Categories::findOrFail($id);
        $categories->update($request->all());

        return response()->json($categories);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories, $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();

        return response()->json([
            'message' => 'Category berhasil dihapus',
            'data' => ($categories)
        ]);
    }
}
