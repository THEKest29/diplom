@extends('layouts.app')

@section('content')
<div class="container py-4" style="align-items: center;">
    <div class="row">
        <!-- Левая колонка - Обложка -->
        <div class="col-md-4">
            <div class="manga-cover-wrapper"> <!-- Заменили sticky-top на кастомный класс -->
                <img src="{{ Storage::url($manga->cover_path) }}" 
                     class="manga-cover-img rounded" 
                     alt="{{ $manga->title }}">
            </div>
        </div>

        <!-- Правая колонка - Контент -->
        <div class="col-md-8">
            <ul class="nav nav-tabs mb-4" id="mangaTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" 
                            data-bs-target="#info" type="button" role="tab">
                        Основная информация
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="characters-tab" data-bs-toggle="tab" 
                            data-bs-target="#characters" type="button" role="tab">
                        Персонажи
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" 
                            data-bs-target="#reviews" type="button" role="tab">
                        Отзывы
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="mangaTabsContent">
                <!-- Вкладка 1: Основная информация -->
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <div class="info-container p-4 rounded">
                    <h2 class="mb-3">{{ $manga->title }}</h2>
                    @if($manga->original_title)
                        <h5 class="mb-4">{{ $manga->original_title }}</h5>
                    @endif

                    <div class="mb-4">
                        <h5>Описание</h5>
                        <p class="text-justify">{{ $manga->description }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Автор:</strong> {{ $manga->author }}</p>
                            <p><strong>Художник:</strong> {{ $manga->artist ?? 'Не указан' }}</p>
                            <p><strong>Издатель:</strong> {{ $manga->publisher ?? 'Не указан' }}</p>
                            <p><strong>Жанр: </strong> @foreach($manga->genres as $genre) <span class="badge bg-info">{{ $genre->name }}</span> @endforeach</p>
                        </div>
                        <div class="col-md-6">
                            @php
                            $statusLabels = [
                            'ongoing' => 'Выходит',
                            'completed' => 'Завершена',
                            'hiatus' => 'Перерыв',
                            'cancelled' => 'Отменена'
                            ];
                            @endphp

                        <p><strong>Статус:</strong> 
                            <span class="badge bg-{{ 
                                $manga->status == 'ongoing' ? 'primary' : 
                                ($manga->status == 'completed' ? 'success' : 'secondary') 
                            }}">
                        {{ $statusLabels[$manga->status] ?? 'Неизвестно' }}
                        </span>
                        </p>
                            <p><strong>Год начала выпуска:</strong> {{ $manga->year ?? 'Не указан' }}</p>
                            <p><strong>Год окончания выпуска:</strong> {{ $manga->end_year ?? 'Не указан' }}</p>
                            <p><strong>Томов:</strong> {{ $manga->volumes ?? 'Не указано' }}</p>
                        </div>
                    </div>

                            <div class="rating-section mb-4">
            <h5>Рейтинг</h5>
            <div class="d-flex align-items-center gap-3">
                <!-- Средний рейтинг -->
                <div class="average-rating">
                    <span class="display-4 fw-bold">{{ number_format($manga->averageRating(), 1) }}</span>
                    <span>/5</span>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star-fill {{ $i <= round($manga->averageRating()) ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                    </div>
                    <small>(оценок всего: {{ $manga->ratings->count() }})</small>
                </div>
                
                <!-- Форма для оценки -->
                @auth
                <div class="user-rating">
                    <form action="{{ route('manga.rate', $manga->id) }}" method="POST" class="rating-form" style="background-color: transparent !important;">
                        @csrf
                        Поставьте оценку
                        <div class="stars-input">
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                       {{ $manga->userRating() == $i ? 'checked' : '' }}>
                                <label for="star{{ $i }}" class="star-label">
                                    <i class="bi bi-star-fill"></i>
                                </label>
                            @endfor
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary mt-2">Оценить</button>
                    </form>
                </div>
                @else
                <div class="guest-notice">
                    <a href="{{ route('login') }}" class="btn btn-link">Войдите</a> чтобы оценить
                </div>
                @endauth
@auth
    <div class="favorite-section mb-3">
        @if(auth()->user()->favorites->contains($manga))
            <form action="{{ route('manga.favorite.remove', $manga) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-heart-fill"></i> Удалить из избранного
                </button>
            </form>
        @else
            <form action="{{ route('manga.favorite.add', $manga) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-heart"></i> В избранное
                </button>
            </form>
        @endif
    </div>
@else
    <div class="guest-notice">
        <a href="{{ route('login') }}" class="btn btn-link">Войдите</a> чтобы добавить в избранное
    </div>
@endauth
            </div>
        </div>
                </div>
            </div>

                <!-- Вкладка 2: Персонажи -->
                <div class="tab-pane fade" id="characters" role="tabpanel">
                    <div class="characters-container p-4 rounded">
                        @if($manga->characters->count() > 0)
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                            @foreach($manga->characters as $character)
                            <div class="col">
                                <div class="character-card position-relative h-100 overflow-hidden rounded">
                                    <!-- Основное изображение -->
                                    <img src="{{ Storage::url($character->image_path) }}" 
                                         class="card-img-top rounded w-100 h-100" 
                                         style="height: 200px; object-fit: cover;"
                                         alt="{{ $character->name }}">
                                    
                                    <!-- Имя персонажа (постоянно видно) -->
                                    <div class="character-name position-absolute bottom-0 start-0 w-100 p-2 text-center text-white"
                                         style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); z-index: 1;">
                                        {{ $character->name }}
                                    </div>
                                    
                                    <!-- Описание (появляется при наведении) -->
                                    <div class="character-description position-absolute top-0 start-0 w-100 h-100 p-3 d-flex align-items-center justify-content-center text-white text-center flex-column"
                                         style="background: rgba(0,0,0,0.85); opacity: 0; transition: all 0.3s ease; z-index: 2;">
                                        <div class="mb-2 fw-bold">{{ $character->name }}</div>
                                        <div class="small">{{ $character->description ?? 'Описание отсутствует' }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="empty-state-icon mb-3">
                            <i class="bi bi-people-fill" style="font-size: 3rem; color: #6c757d;"></i>
                        </div>
                        <h5>Персонажи пока не добавлены</h5>
                        <p>Здесь будут отображаться персонажи манги</p>
                    </div>
                @endif
                </div>
                </div>

                <!-- Вкладка 3: Отзывы -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="reviews-container p-4 rounded">
                        @auth
                        <!-- Форма отзыва -->
                        <div class="review-card card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Оставить отзыв</h5>
                                <form action="{{ route('reviews.store') }}" method="POST" id="review-form" class="review-form">
                                    @csrf
                                    <input type="hidden" name="manga_id" value="{{ $manga->id }}">
                                    
                                    <div class="mb-3">
                                        <textarea name="comment" class="form-control" 
                                                  rows="3" required minlength="10" 
                                                  placeholder="Напишите ваш отзыв..."></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">
                                        Отправить отзыв
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endauth
                        @if($manga->reviews->count() > 0)
                    <div class="reviews-list">
                        @foreach($manga->reviews->sortByDesc('created_at') as $review)
                        <div class="card mb-3">
                            <div class="card-body review-card">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6>{{ $review->user->nick }}</h6>
                                    <small>{{ $review->created_at->format('d.m.Y H:i') }}</small>
                                </div>
                                <p>{{ $review->comment }}</p>
                                
                                <div class="d-flex align-items-center gap-3">
                                    <!-- Лайк -->
                                    <form class="vote-form" method="POST" action="{{ route('reviews.vote', $review->id) }}">
                                        @csrf
                                        <input type="hidden" name="type" value="like">
                                        <button class="btn btn-sm btn-outline-success">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>
                                            </svg>
                                            <span class="likes-count">{{ $review->likes}}</span>
                                        </button>
                                    </form>
                                
                                    <!-- Дизлайк -->
                                    <form class="vote-form" method="POST" action="{{ route('reviews.vote', $review->id) }}">
                                        @csrf
                                        <input type="hidden" name="type" value="dislike">
                                        <button class="btn btn-sm btn-outline-danger">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"/>
                                            </svg>
                                            <span class="dislikes-count">{{ $review->dislikes }}</span>
                                        </button>
                                    </form>
                                    
                                    @can('delete', $review)
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="ms-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить отзыв?')">
                                            <i class="bi bi-trash">Удалить</i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                    <h5>Отзывы пока не добавлены</h5>
                    <p>Здесь будут отображаться отзывы пользователей к манге</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('styles')
<style>
    /* Стили для карточек персонажей */
    .character-card {
        cursor: pointer;
        transition: transform 0.2s;
    }
    .character-card:hover {
        transform: scale(1.03);
    }
    .character-card:hover .character-description {
        opacity: 1 !important;
    }

    /* Стили для вкладок */
    .nav-tabs .nav-link {
        font-weight: 500;
    }

    /* Стили для отзывов */
    .like-btn.active {
        background-color: #198754;
        color: white;
    }
    .dislike-btn.active {
        background-color: #dc3545;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Обработчик для форм голосования
        document.querySelectorAll('.vote-form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault(); // Важно: отменяем стандартное поведение формы
                
                const button = this.querySelector('button');
                const counter = this.querySelector('span');
                const formData = new FormData(this);
                
                try {
                    button.disabled = true;
                    button.classList.add('voting');
                    
                    const response = await fetch(this.action, {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest' // Важно для Laravel
    },
    body: formData
});
                    
                    if (!response.ok) throw new Error('Ошибка сервера');
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        counter.textContent = data[formData.get('type') + 's'];
                        button.classList.add('voted');
                        setTimeout(() => button.classList.remove('voted'), 300);
                    }
                    
                } catch (error) {
                    console.error('Ошибка:', error);
                    alert('Не удалось проголосовать');
                } finally {
                    button.disabled = false;
                    button.classList.remove('voting');
                }
            });
        });
    });
    </script>
    <script>
        document.querySelectorAll('.rating-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: new FormData(form)
        });
        
        if (response.ok) {
            location.reload(); // или обновите только рейтинг через JS
        }
    });
});
        </script>
@endpush
@endsection