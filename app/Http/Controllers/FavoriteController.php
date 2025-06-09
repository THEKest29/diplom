<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
        public function store(Manga $manga)
    {
        auth()->user()->favorites()->syncWithoutDetaching([$manga->id]);
        return back()->with('success', 'Манга добавлена в избранное');
    }

    public function destroy(Manga $manga)
    {
        auth()->user()->favorites()->detach($manga->id);
        return back()->with('success', 'Манга удалена из избранного');
    }
}
