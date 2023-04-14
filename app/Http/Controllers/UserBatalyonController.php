<?php

namespace App\Http\Controllers;

use App\Models\UserBatalyon;
use App\Http\Requests\StoreUserBatalyonRequest;
use App\Http\Requests\UpdateUserBatalyonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBatalyonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userBatalyon = UserBatalyon::all();
        return response()->json($userBatalyon);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'korwil' => 'required|max:255',
            'jabatan' => 'required',
            'dpc' => 'required|max:255',
        ]);

        $userBatalyon = UserBatalyon::create([
            'name' => $request->name,
            'korwil' => $request->korwil,
            'jabatan' => $request->jabatan,
            'dpc' => $request->dpc,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'message' => 'Add Data User Batalyon Success',
            'data' => ($userBatalyon)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserBatalyon $userBatalyon, $id)
    {
        $userBatalyon = UserBatalyon::findOrFail($id);
        return response()->json($userBatalyon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserBatalyon $userBatalyon, $id)
    {
        $request->validate([
            'jabatan' => 'required|max:255',
            'dpc' => 'required',
        ]);

        $userBatalyon = UserBatalyon::findOrFail($id);
        $userBatalyon->update($request->all());

        return response()->json([
            'message' => 'Data User Batalyon Updated Success',
            'data' => ($userBatalyon)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserBatalyon $userBatalyon, $id)
    {
        $userBatalyon = UserBatalyon::findOrFail($id);
        $userBatalyon->delete();

        return response()->json([
            'message' => 'Delete Data User Batalyon Success',
            'data' => ($userBatalyon)
        ]);
    }
}
