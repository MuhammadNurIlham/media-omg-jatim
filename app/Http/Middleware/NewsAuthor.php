<?php

namespace App\Http\Middleware;

use App\Models\News;
use App\Models\Program;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NewsAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $currentUser = Auth::user();
        $news = News::findOrFail($request->id);
        $program = Program::findOrFail($request->id);

        // if ($news->user_id != $currentUser->id) {
        //     return response()->json(['message' => 'Not Found'], 404);
        // }

        if (($news && $news->user_id !== $currentUser->id) || ($program && $program->user_id !== $currentUser->id)) {
            return response()->json(['message' => 'Data Not Found'], 404);
        }
        return $next($request);
    }
}
