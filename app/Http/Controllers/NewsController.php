<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Resources\NewsDetailResource;
use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = News::all();
        return NewsDetailResource::collection($news->loadMissing(['writer:id,name', 'kategori:id,name'])); // using API Resource
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $news = News::with([
            'writer:id,name',
            'kategori:id,name'
        ])->findOrFail($id);
        return new NewsDetailResource($news); // using API Resource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $news = News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);

        return new NewsDetailResource($news->loadMissing(['writer:id,name', 'category:id,name']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->all());

        return new NewsDetailResource($news->loadMissing(['writer:id,name', 'category:id,name']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news, $id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        // return (new NewsDetailResource($news->loadMissing(['writer:id,name', 'category:id,name'])))
        //     ->additional(['message' => 'Berita berhasil dihapus.']);

        return [
            'message' => 'Berita berhasil dihapus',
            'data' => new NewsDetailResource($news->loadMissing(['writer:id,name', 'category:id,name']))
        ];
    }
}
