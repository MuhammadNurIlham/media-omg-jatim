<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $report = Report::all();
        return response()->json($report);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'desc' => 'required',
            'date' => 'required',
            'file' => 'required|max:255',
            'batalyon_id' => 'required|exists:batalyon_id'
        ]);

        $report = Report::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'date' => $request->date,
            'file' => $request->file,
            'user_id' => Auth::user()->id,
            'batalyon_id' => $request->batalyon_id,
        ]);

        return response()->json($report); //sementara

        // return new NewsDetailResource($news->loadMissing(['writer:id,name', 'category:id,name']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report, $id)
    {
        $report = Report::findOrFail($id);
        return response()->json($report);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $report = Report::findOrFail($id);
        $report->update($request->all());

        return response()->json($report);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report, $id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return response()->json($report);
    }
}
