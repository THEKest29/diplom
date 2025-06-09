@extends('layouts.app') <!-- Если используете стандартный layout -->

@section('content')
<div class="container">
    <!-- Поисковая строка и фильтры -->
    <div class="filters mb-4">
      <form method="GET" action="{{ route('manga.index') }}" style="padding: 15px;">
          <div class="row g-2 align-items-center">
              <!-- Поиск по названию -->
              <div class="col-md-4 col-12">
                <label class="form-label mb-1">Название</label>
                <input type="text" name="search" class="form-control w-100" 
                       value="{{ request('search') }}">
            </div>
            
            <div class="col-md-2 col-6">
                <label class="form-label mb-1">Автор</label>
                <input type="text" name="author" class="form-control w-100" 
                       value="{{ request('author') }}">
            </div>
              
              <!-- Фильтр по жанру -->
              <div class="col-md-2 col-6">
                  <label class="form-label mb-1">Жанр</label>
                  <select name="genre" class="form-select">
                      <option value="">Все</option>
                      @foreach($genres as $genre)
                          <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                              {{ $genre->name }}
                          </option>
                      @endforeach
                  </select>
              </div>
              
              <!-- Фильтр по статусу -->
              <div class="col-md-2 col-6">
                  <label class="form-label mb-1">Статус</label>
                  <select name="status" class="form-select">
                      <option value="">Все</option>
                      <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Онгоинг</option>
                      <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Завершён</option>
                      <option value="hiatus" {{ request('status') == 'hiatus' ? 'selected' : '' }}>Хаитус</option>
                      <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Отменён</option>
                  </select>
              </div>
              
              <!-- Кнопки -->
              <div class="col-md-2 col-6 d-flex gap-2" style="margin-top: 35px;">
                  <button type="submit" class="btn btn-primary flex-grow-1">
                      Фильтр
                  </button>
                  <button type="button" 
                  class="btn btn-secondary flex-grow-1"
                  onclick="window.location.href='{{ route('manga.index') }}'">
              Сброс
          </button>
              </div>
          </div>
      </form>
  </div>

    <!-- Список манги -->
    <div class="row">
      @forelse ($mangas as $manga)
      <div class="col-md-3 mb-4 d-grid justify-content-center">
          <div style="width:252px; height:396px; position:relative;">
              <!-- 1. Картинка -->
              <img src="{{ Storage::url($manga->cover_path) }}"
                   style="
                     width:100%;
                     height:100%;
                     object-fit:contain;
                     background:#f0f0f0;
                     position:relative;
                     z-index:1;
                   ">
              
              <!-- 2. Текст поверх -->
              <div style="
                     position:absolute;
                     top:0;
                     left:0;
                     width:100%;
                     height:100%;
                     background:rgba(0,0,0,0.7);
                     color:white;
                     display:flex;
                     align-items:center;
                     justify-content:center;
                     opacity:0;
                     transition:0.3s;
                     z-index:2;
                   ">
                  <h5 style="padding:15px; text-align:center">{{ $manga->title }}</h5>
              </div>
              
              <!-- 3. Ссылка -->
              <a href="{{ route('manga.show', $manga->id) }}"
                 style="
                   position:absolute;
                   top:0;
                   left:0;
                   width:100%;
                   height:100%;
                   z-index:3;
                 "></a>
          </div>
      </div>
      @empty
      <div class="col-12 text-center py-5">
          <div class="empty-results">
              <i class="bi bi-search" style="font-size: 3rem; color: #6c757d;"></i>
              <h3 class="mt-3">Ничего не найдено</h3>
              <p>Попробуйте изменить параметры поиска</p>
              
              @if(request()->hasAny(['search', 'author', 'genre']))
              <a href="{{ route('manga.index') }}" class="btn btn-primary mt-3">
                  <i class="bi bi-arrow-counterclockwise"></i> Сбросить фильтры
              </a>
              @endif
          </div>
      </div>
      @endforelse
  </div>
      
      <script>
      // Простейший hover без CSS (на случай проблем)
      document.querySelectorAll('.col-md-3 > div').forEach(el => {
        el.addEventListener('mouseenter', () => {
          el.children[1].style.opacity = 1;
        });
        el.addEventListener('mouseleave', () => {
          el.children[1].style.opacity = 0;
        });
      });
      </script>
@endsection