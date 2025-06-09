@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm review-card">
    <!-- Текущий аватар -->
<div class="card-body text-center">
    <!-- Текущий аватар -->
    <div class="mb-3 d-flex justify-content-center"> <!-- Добавлен flex-контейнер -->
        @if($user->avatar && file_exists(public_path('img/avatars/'.$user->avatar)))
            <img src="{{ asset('img/avatars/'.$user->avatar) }}" 
                 class="rounded-circle shadow"
                 width="150"
                 height="150"
                 style="object-fit: cover;">
        @else
            <div class="rounded-circle shadow bg-light d-flex align-items-center justify-content-center" 
                 style="width:150px; height:150px;">
                <span>Нет аватара</span>
            </div>
        @endif
    </div>

    <!-- Кнопка для открытия модального окна -->
    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#avatarModal">
        Изменить аватар
    </button>
    
    <h4 class="mt-3">{{ $user->nick }}</h4>
</div>

<!-- Модальное окно -->
<div class="modal fade" id="avatarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Изменение аватара</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('profile.update.avatar', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Выберите изображение:</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow-sm reviews-container">
                <div class="card-body review-card">
                    <form action="{{ route('profile.update.description', $user) }}" method="POST" style="background-color: rgba(255, 255, 255, 0);">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">О себе:</label>
                            <textarea class="form-control" name="description" rows="5"
                                      placeholder="Расскажите о себе...">{{ old('description', $user->description) }}</textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                Сохранить описание
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mt-4 review-card" style="padding: 0px;">
    <div class="card-header" style="background-color: rgba(255, 255, 255, 0);">
        <h5>Избранная манга</h5>
    </div>
    <div class="card-body review-card" style="margin: 10px;">
        @if($user->favorites->count() > 0)
<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
    @foreach($user->favorites as $manga)
        <div class="col mb-4">
            <div class="card border-0 bg-transparent h-100">
                <!-- Обложка -->
                <a href="{{ route('manga.show', $manga) }}" class="d-block overflow-hidden rounded">
                    @if($manga->cover_path && file_exists(public_path('storage/' . str_replace('storage/', '', $manga->cover_path))))
                        <img src="{{ asset('storage/' . str_replace('storage/', '', $manga->cover_path)) }}" 
                             class="img-fluid w-100" 
                             style="height: 300px; object-fit: cover;"
                             alt="{{ $manga->title }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </a>
                
                <!-- Название -->
                <div class="card-body p-0 pt-2 text-center">
                    <a href="{{ route('manga.show', $manga) }}" 
                       class="text-dark text-decoration-none fw-medium">
                        {{ Str::limit($manga->title, 20) }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
        @else
            <p>Вы еще не добавили ни одной манги в избранное</p>
        @endif
    </div>
</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Обработка формы в модальном окне
    const avatarForm = document.querySelector('#avatarModal form');
    
    if (avatarForm) {
        avatarForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Сохранение...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Обновляем аватар на странице
                    const avatarImg = document.querySelector('.card-body .rounded-circle');
                    if (avatarImg) {
                        avatarImg.src = data.avatar_url + '?v=' + new Date().getTime();
                    }
                    
                    // Закрываем модальное окно
                    bootstrap.Modal.getInstance(document.getElementById('avatarModal')).hide();
                    
                    // Показываем уведомление
                    alert('Аватар успешно обновлён!');
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Сохранить изменения';
            });
        });
    }
});
</script>
@endsection