<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MangaController extends Controller
{
    public function create()
    {
        $genres = Genre::all();
        return view('manga.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'original_title' => 'nullable|string|max:255',
            'author' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'status' => 'required|in:ongoing,completed,hiatus,canceled',
            'year' => 'nullable|integer|min:1900|max:2099',
            'description' => 'required|string|max:2000',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'publisher' => 'nullable|string|max:255',
            'volumes' => 'nullable|integer|min:0',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        // Сохраняем обложку
        $coverPath = $request->file('cover')->store('manga_covers', 'public');

        // Создаем мангу
        $manga = Manga::create([
            'title' => $validated['title'],
            'original_title' => $validated['original_title'],
            'author' => $validated['author'],
            'artist' => $validated['artist'],
            'status' => $validated['status'],
            'year' => $validated['year'],
            'description' => $validated['description'],
            'cover_path' => $coverPath,
            'publisher' => $validated['publisher'],
            'volumes' => $validated['volumes'],
        ]);

        // Привязываем жанры
        $manga->genres()->attach($validated['genres']);

        return redirect()->route('manga.show', $manga)
            ->with('success', 'Манга успешно добавлена!');
    }
}
