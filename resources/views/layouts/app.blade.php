<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Мир манги</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>
    <body class="light-theme d-flex flex-column min-vh-100">
      <header class="navbar navbar-expand-lg">
        <div class="container">
          <!-- Логотип -->
          <a class="navbar-brand" href="{{route('index')}}">
            <img src="{{ asset('img/logo.png') }}" alt="Логотип" style="height: 50px;">
          </a>
      
          <!-- Контейнер для элементов справа -->
          <div class="d-flex align-items-center order-lg-3">
            <!-- Переключатель темы -->
            <label class="theme-switch me-3">
              <input type="checkbox" id="theme-toggle">
              <span class="slider"></span>
            </label>
      
            <!-- Кнопка для мобильного меню -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
      
          <!-- Навигация -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Все элементы навигации в одном вертикальном списке для мобильных -->
            <ul class="navbar-nav me-auto mb-lg-0">
              <!-- Основные ссылки -->
              <li class="nav-item"><a class="nav-link" href="{{ route('history')}}">История</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('manga.index')}}">Библиотека</a></li>
              
              @auth
                @if(Auth::user()->status === 'admin')
                  <li class="nav-item"><a class="nav-link" href="/admin">Админ-панель</a></li>
                @endif
              @endauth
            </ul>
            <ul class="navbar-nav mb-lg-0">
              <!-- Блок авторизации -->
              @if(Auth::check())
                <li class="nav-item">
                  <div class="d-flex align-items-center">
    <a href="{{ route('profile.show', Auth::id()) }}" class="nav-link me-2">
        {{ Auth::user()->nick }}
    </a>
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-link nav-link">Выйти</button>
    </form>
</div>
                </li>
              @else
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Регистрация</a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Авторизация</a></li>
              @endif
            </ul>
          </div>
        </div>
      </header>          
    <main>
        @yield('content')
    </main>
<footer class="site-footer mt-auto">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="brand-wrapper">
                    <h2 class="brand-title">Мир манги</h2>
                </div>
                <p class="footer-text">Мы ответим на ваши вопросы</p>
                <a href="#" class="nav-link" style="padding-left:0px;">Оставьте вопросы по этой ссылке</a>
            </div>
            
            <div class="footer-contacts">
              <div class="brand-wrapper">
                <h3 class="brand-title">Контакты</h3>
              </div>
                <p class="footer-text">+7 (960) 071-33-55</p>
                <p class="footer-text">ул. 40 лет Победы</p>
                <p class="footer-text">mangaworld@gmail.com</p>
            </div>
        </div>
        
        <div class="footer-copyright">
            <p class="copyright-text">mangaworld.com &copy; 2025</p>
        </div>
    </div>
</footer>
<style>
    .site-footer {
        background-color: #2a2a2a;
        color: #ffffff;
        padding: 40px 0 0;
        font-family: 'Montserrat', sans-serif;
    }
    
    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 30px;
        padding-bottom: 30px;
    }
    
    .footer-brand {
        flex: 1;
        min-width: 250px;
    }
    
    .brand-wrapper {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .brand-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }
    
    .footer-contacts {
        flex: 1;
        min-width: 250px;
    }
    
    .footer-heading {
        font-size: 20px;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }
    
    .footer-heading:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
    }
    
    .footer-text {
        margin-bottom: 12px;
        line-height: 1.6;
        color: #d1d1d1;
    }
    
    .footer-link {
        display: inline-block;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
        margin-top: 10px;
    }
    
    .footer-link:hover {
        text-decoration: underline;
    }
    
    .footer-copyright {
        border-top: 1px solid #444;
        padding: 20px 0;
        text-align: center;
    }
    
    .copyright-text {
        color: #aaa;
        margin: 0;
        font-size: 14px;
    }
    
    /* Иконки Font Awesome */
    .fas {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }
    
    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            gap: 20px;
        }
        
        .brand-title {
            font-size: 24px;
        }

        .brand-wrapper {
          justify-content: center;
        }
    }
</style>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/theme-switcher.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const coverInput = document.getElementById('cover');
          const coverPreview = document.getElementById('coverPreview');
          const uploadArea = document.getElementById('uploadArea');
      
          // Обработчик клика
          uploadArea.addEventListener('click', () => coverInput.click());
      
          // Обработчик изменения файла
          coverInput.addEventListener('change', function(e) {
              if (e.target.files.length) {
                  updatePreview(e.target.files[0]);
              }
          });
      
          // Drag-and-drop обработчики
          uploadArea.addEventListener('dragover', (e) => {
              e.preventDefault();
              uploadArea.style.borderColor = '#0d6efd';
              uploadArea.style.backgroundColor = '#e9f0ff';
          });
      
          uploadArea.addEventListener('dragleave', () => {
              uploadArea.style.borderColor = '#dee2e6';
              uploadArea.style.backgroundColor = '';
          });
      
          uploadArea.addEventListener('drop', (e) => {
              e.preventDefault();
              uploadArea.style.borderColor = '#dee2e6';
              uploadArea.style.backgroundColor = '';
              
              if (e.dataTransfer.files.length) {
                  coverInput.files = e.dataTransfer.files;
                  updatePreview(e.dataTransfer.files[0]);
              }
          });
      
          // Обновление превью
          function updatePreview(file) {
              const reader = new FileReader();
              reader.onload = (e) => {
                  coverPreview.src = e.target.result;
                  uploadArea.querySelector('p').textContent = file.name;
              };
              reader.readAsDataURL(file);
          }
      });

      // Используйте Select2 для удобного выбора
      document.addEventListener('DOMContentLoaded', function() {
    $('#genreSelect').select2({
        placeholder: "Выберите жанры",
        allowClear: true,
        width: '100%'
    });
});
      </script>
    </body>
</html>