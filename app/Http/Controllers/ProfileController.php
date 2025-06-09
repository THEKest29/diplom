<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }

public function updateAvatar(Request $request, User $user)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Путь к папке с аватарами
    $avatarDir = public_path('img/avatars');
    
    // Создаём папку, если её нет
    if (!file_exists($avatarDir)) {
        mkdir($avatarDir, 0755, true);
    }

    // Удаляем старый аватар
    if ($user->avatar && file_exists($avatarDir.'/'.$user->avatar)) {
        unlink($avatarDir.'/'.$user->avatar);
    }

    // Генерируем уникальное имя файла
    $filename = 'avatar_'.$user->id.'_'.time().'.'.$request->file('avatar')->extension();
    
    // Сохраняем файл
    $request->file('avatar')->move($avatarDir, $filename);
    
    // Обновляем запись в БД
    $user->update(['avatar' => $filename]);

    return response()->json([
        'success' => true,
        'avatar_url' => asset('img/avatars/'.$filename)
    ]);
}

    public function updateDescription(Request $request, User $user)
    {
        $request->validate([
            'description' => 'nullable|string|max:500'
        ]);

        $user->update(['description' => $request->description]);

        return back()->with('success', 'Описание успешно обновлено!');
    }
}
