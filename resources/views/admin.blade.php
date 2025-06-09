@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Табы для переключения между формами -->
    <ul class="nav nav-tabs mb-4" id="formTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="manga-tab" data-bs-toggle="tab" data-bs-target="#manga-form" type="button" role="tab" aria-controls="manga-form" aria-selected="true">
                Добавить/удалить мангу
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="character-tab" data-bs-toggle="tab" data-bs-target="#character-form" type="button" role="tab" aria-controls="character-form" aria-selected="false">
                Добавить персонажа
            </button>
        </li>
    </ul>

    <!-- Содержимое табов -->
    <div class="tab-content" id="formTabsContent">
        <!-- Форма добавления манги -->
        <div class="tab-pane fade show active" id="manga-form" role="tabpanel" aria-labelledby="manga-tab">
            <form id="addMangaForm" method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data" style="padding: 15px; border-radius: 10px;">
                @csrf
                
                <!-- Поле для обложки -->
                <div class="mb-4 text-center">
                    <img id="coverPreview" src="{{ asset('placeholder.jpg') }}" class="cover-preview">
                    <div class="upload-area" id="uploadArea">
                        <i class="bi bi-cloud-arrow-up fs-1"></i>
                        <p>Перетащите сюда обложку или кликните для выбора</p>
                        <input type="file" id="cover" name="cover" accept="image/*" class="d-none" required>
                    </div>
                    @error('cover')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Основные поля -->
                <div class="mb-3">
                    <label for="title" class="form-label">Название манги*</label>
                    <input type="text" class="form-control w-100 @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="original_title" class="form-label">Оригинальное название</label>
                    <input type="text" class="form-control w-100 @error('original_title') is-invalid @enderror" 
                           id="original_title" name="original_title" value="{{ old('original_title') }}">
                    @error('original_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label">Автор*</label>
                        <input type="text" class="form-control w-100 @error('author') is-invalid @enderror" 
                               id="author" name="author" value="{{ old('author') }}" required>
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="artist" class="form-label">Художник</label>
                        <input type="text" class="form-control w-100 @error('artist') is-invalid @enderror" 
                               id="artist" name="artist" value="{{ old('artist') }}">
                        @error('artist')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Статус*</label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="" disabled selected>Выберите статус</option>
                            <option value="ongoing" @if(old('status') == 'ongoing') selected @endif>Продолжается</option>
                            <option value="completed" @if(old('status') == 'completed') selected @endif>Завершена</option>
                            <option value="hiatus" @if(old('status') == 'hiatus') selected @endif>Перерыв</option>
                            <option value="canceled" @if(old('status') == 'canceled') selected @endif>Отменена</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="year" class="form-label">Год начала выпуска</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" 
                               id="year" name="year" value="{{ old('year') }}" min="1900" max="2099">
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                        <label for="end_year" class="form-label">Год окончания выпуска</label>
                        <input type="number" class="form-control @error('end_year') is-invalid @enderror" 
                               id="end_year" name="end_year" value="{{ old('end_year') }}" min="1900" max="2099">
                        @error('end_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                <!-- Жанры -->
                <div class="mb-3">
                    <label class="form-label">Жанры*</label>
                    <select class="form-select @error('genres') is-invalid @enderror" 
                            id="genreSelect" name="genres[]" multiple required>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" 
                                {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genres')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Описание -->
                <div class="mb-3">
                    <label for="description" class="form-label">Описание*</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Дополнительные поля -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="publisher" class="form-label">Издательство</label>
                        <input type="text" class="form-control w-100 @error('publisher') is-invalid @enderror" 
                               id="publisher" name="publisher" value="{{ old('publisher') }}">
                        @error('publisher')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="volumes" class="form-label">Количество томов</label>
                        <input type="number" class="form-control @error('volumes') is-invalid @enderror" 
                               id="volumes" name="volumes" value="{{ old('volumes') }}" min="0">
                        @error('volumes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Опубликовать мангу</button>
                </div>
            </form>
            <div class="mt-5 mb-3 p-4 border rounded">
    <h3 class="text-danger mb-4">Удаление манги</h3>
    
    <form id="deleteMangaForm" method="POST" action="{{ route('admin.manga.delete') }}" class="mb-4" style="background-color: transparent;">
        @csrf
        @method('DELETE')
        
        <div class="row">
            <div class="col-md-8">
                <label for="mangaSelect" class="form-label">Выберите мангу для удаления:</label>
                <select class="form-select" id="mangaSelect" name="id" required>
                    <option value="" selected disabled>-- Выберите мангу --</option>
                    @foreach($mangas as $manga)
                        <option value="{{ $manga->id }}">{{ $manga->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="button" class="btn btn-danger w-100" id="deleteBtn" disabled>
                    Удалить мангу
                </button>
            </div>
        </div>
    </form>
    
    <!-- Модальное окно подтверждения -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Подтверждение удаления</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить мангу "<strong id="mangaTitle"></strong>"?</p>
                    <p class="text-danger">Это действие невозможно отменить! Все связанные данные будут удалены.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" form="deleteMangaForm" class="btn btn-danger">Подтвердить удаление</button>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        
        <!-- Форма добавления персонажа -->
        <div class="tab-pane fade" id="character-form" role="tabpanel" aria-labelledby="character-tab">
            <form method="POST" action="{{ route('admin.characters.store') }}" enctype="multipart/form-data" style="padding: 15px; border-radius: 10px;">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Манга*</label>
                    <select class="form-select" name="manga_id" required>
                        <option value="" disabled selected>Выберите мангу</option>
                        @foreach($mangas as $manga)
                            <option value="{{ $manga->id }}">{{ $manga->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Имя персонажа*</label>
                    <input type="text" name="name" class="form-control w-100" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Изображение*</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Описание*</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Добавить персонажа</button>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success mt-3">
    {{ session('success') }}
</div>
@endif

<!-- Подключение Bootstrap JS (если еще не подключен) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('mangaSelect');
    const deleteBtn = document.getElementById('deleteBtn');
    const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const mangaTitle = document.getElementById('mangaTitle');
    
    // Активировать кнопку при выборе манги
    select.addEventListener('change', function() {
        deleteBtn.disabled = !this.value;
    });
    
    // Показать подтверждение перед удалением
    deleteBtn.addEventListener('click', function() {
        const selectedOption = select.options[select.selectedIndex];
        mangaTitle.textContent = selectedOption.text.split(' (ID:')[0];
        modal.show();
    });
});
</script>
@endsection