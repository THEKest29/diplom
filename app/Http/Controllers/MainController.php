<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Genre;
use App\Models\Review;

class MainController extends Controller
{
    public function view() {
        return view('index');
    }

    public function view_history() {
        return view('history');
    }

    public function show($id)
    {
        $manga = Manga::with(['genres', 'characters', 'reviews.user'])->findOrFail($id);
        return view('info', compact('manga'));
    }

public function view_manga(Request $request)
{
    $query = Manga::query()->with('genres');
    
    // Поиск по названию
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%'.$request->search.'%')
              ->orWhere('original_title', 'like', '%'.$request->search.'%');
        });
    }

    // Фильтр по автору (точное совпадение)
    if ($request->filled('author')) {
        $query->where('author', 'like', '%'.$request->author.'%');
    }

    // Фильтр по статусу
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Фильтр по жанру
    if ($request->filled('genre')) {
        $query->whereHas('genres', function($q) use ($request) {
            $q->where('genres.id', $request->genre);
        });
    }

    $mangas = $query->paginate(12)->withQueryString();
    $genres = Genre::all();

    return view('manga', compact('mangas', 'genres'));
}
public function store(Request $request)
{
    $validated = $request->validate([
        'comment' => 'required|string|min:10|max:1000',
        'manga_id' => 'required|exists:manga,id'
    ]);

    try {
        auth()->user()->reviews()->create([
            'manga_id' => $validated['manga_id'],
            'comment' => $validated['comment']
        ]);

        return back()->with('success', 'Отзыв добавлен!');
    } catch (\Exception $e) {
        return back()->with('error', 'Ошибка: '.$e->getMessage());
    }
}

// ReviewController.php
public function vote(Request $request, Review $review)
{
    // Проверка авторизации
    if (!auth()->check()) {
        if ($request->wantsJson()) {
            return response()->json(['error' => 'Требуется авторизация'], 401);
        }
        return redirect()->back()->with('error', 'Требуется авторизация');
    }

    // Валидация
    $request->validate(['type' => 'required|in:like,dislike']);

    // Проверка на повторное голосование
    $sessionKey = 'voted_'.$review->id;
    if (session()->has($sessionKey)) {
        if ($request->wantsJson()) {
            return response()->json(['error' => 'Вы уже голосовали за этот отзыв'], 403);
        }
        return redirect()->back()->with('error', 'Вы уже голосовали за этот отзыв');
    }

    // Обновляем счетчик
    $field = $request->type === 'like' ? 'likes' : 'dislikes';
    $review->increment($field);

    // Запоминаем голос
    session([$sessionKey => true]);

    // Возвращаем JSON только для AJAX-запросов
    if ($request->wantsJson()) {
        return response()->json([
            'success' => true,
            'likes' => $review->fresh()->likes,
            'dislikes' => $review->fresh()->dislikes
        ]);
    }

    return redirect()->back();
}

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Отзыв удалён!');
    }
    public function rate(Request $request, Manga $manga)
{
    $validated = $request->validate([
        'rating' => 'required|integer|between:1,5'
    ]);
    
    $manga->ratings()->updateOrCreate(
        ['user_id' => auth()->id()],
        ['rating' => $validated['rating']]
    );
    
    return back()->with('success', 'Ваша оценка сохранена!');
}
}
