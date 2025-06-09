<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Genre;
use App\Models\Character;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function create()
{
    $genres = Genre::all();
    return view('admin.create', compact('genres'));
}

    public function show($id)
{
    $manga = Manga::with('genres')->findOrFail($id);
    return view('admin.show', compact('manga'));
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
            'end_year' => 'nullable|integer|min:1900|max:2099',
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
            'end_year' => $validated['end_year'],
            'description' => $validated['description'],
            'cover_path' => $coverPath,
            'publisher' => $validated['publisher'],
            'volumes' => $validated['volumes'],
        ]);

        // Привязываем жанры
        $manga->genres()->attach($validated['genres']);

        return redirect('/admin')
            ->with('success', 'Манга успешно добавлена!');
    }

    public function createCharacter()
{
    $genres = Genre::all();
    $mangas = Manga::all(); // Получаем список всех манг
    return view('admin', compact('genres', 'mangas'));
}

public function storeCharacter(Request $request)
{
    $validated = $request->validate([
        'manga_id' => 'required|exists:manga,id',
        'name' => 'required|string|max:255',
        'image' => 'required|image|max:2048',
        'description' => 'required|string'
    ]);

    $imagePath = $request->file('image')->store('characters', 'public');

    Character::create([
        'manga_id' => $validated['manga_id'],
        'name' => $validated['name'],
        'image_path' => $imagePath,
        'description' => $validated['description']
    ]);

    return back()->with('success', 'Персонаж успешно добавлен');
}
public function destroy(Request $request)
{
    $request->validate([
        'id' => 'required|exists:manga,id'
    ]);

    $manga = Manga::find($request->id);
    
    // Удаляем связанные данные
    $manga->characters()->delete();
    $manga->reviews()->delete();
    
    // Удаляем файлы обложки (если нужно)
    if ($manga->cover_path) {
        Storage::delete($manga->cover_path);
    }
    
    $manga->delete();
    
    return back()->with('success', 'Манга успешно удалена');
}
}
