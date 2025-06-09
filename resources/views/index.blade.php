@extends('layouts.app')
@section('content')
<main class="main-page">
<h1 class="text-center">Мир манги</h1>
<h2 class="text-center mb-4">узнай про виды комиксов дальнего востока</h2>
<div id="responsiveCarousel" class="carousel slide">
  <div class="carousel-inner">
      <!-- Слайды будут генерироваться через JS -->
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#responsiveCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#responsiveCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
  </button>
</div>

<section class="about-manga py-5">
    <div class="container">
      <div class="row justify-content-center">
          <h2 class="text-center mb-4">Что такое манга?</h2>
          <p class="lead">
            Манга – это японский комикс. Очень часто именно такое определение можно услышать в ответ на вопрос «что такое манга?». Объяснение ёмкое и понятное, но, к сожалению, поверхностное и неудачное, потому что отбивает желание разбираться дальше. На самом деле манга – нечто гораздо большее, недаром это единственный вид комиксов, имеющий собственное название, известное во всем мире. Ниже мы расскажем про различные жанры манги, которые существуют.
          </p>
      </div>
    </div>
  </section>
<h2 class="text-center mb-4">Жанры манги по целевой аудитории</h2>
<section class="genre1 py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Текстовый блок - слева -->
        <div class="col-md-6 order-md-1 order-2">
          <p class="mb-md-0 fs-5 text-center">Кодомо (когомо向く манга 子供向け漫画) — для детей до 12 лет. Яркая рисовка, отсутствие или намеренное упрощение идейного наполнения, простые сюжеты, понятные детям, отсутствие сцен насилия.</p>
        </div>
        
        <!-- Блок с изображением - справа -->
        <div class="col-md-6 order-md-2 order-1 mb-4 mb-md-0">
            <div class="image-block text-center">
              <img src="{{ asset('img/Doraemon_2005.jpg') }}" 
                   alt="Дораэмон (2006 г.)" 
                   class="img-fluid rounded shadow-sm mx-auto d-block"
                   style="max-height: 400px; object-fit: contain;">
              <p class="mt-3 mx-auto" style="max-width: 80%;">
                Дораэмон (2006 г.) - аниме и манга в жанре Кодомо
              </p>
            </div>
          </div>
      </div>
    </div>
  </section>
  <section class="genre2 py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Блок с изображением - слева -->
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="image-block text-center">
              <img src="{{ asset('img/chainsaw_man_5vol.jpg') }}" 
                   alt="Человек-бензопила (Chainsaw-man)" 
                   class="img-fluid rounded shadow-sm mx-auto d-block"
                   style="max-height: 400px; object-fit: contain;">
              <p class="mt-3 mx-auto" style="max-width: 80%;">
                Человек-бензопила (Chainsaw-man) - манга, выпускаемая с 2018 года.
              </p>
            </div>
          </div>
        
        <!-- Текстовый блок - справа -->
        <div class="col-md-6">
          <p class="mb-0 fs-5 text-center">Сёнен (сёнэн манга 少年) — для юношей от 12 до 18 лет. Динамичный сюжет, обилие юмористических и боевых сцен. Основные темы: мужская дружба, соперничество в жизни, спорте, боевых искусствах. Главные герои — пример достойного поведения для подростков: они целеустремлённы, упорны, позитивны и выходят победителями из любых неприятных и опасных ситуаций.</p>
        </div>
      </div>
    </div>
  </section>
  <section class="genre1 py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Текстовый блок - слева -->
        <div class="col-md-6 order-md-1 order-2">
          <p class="mb-md-0 fs-5 text-center">Сёдзё — аниме и манга для старших девочек и девушек (с 12 до 16-18 лет). В сюжете сёдзё аниме, как правило, присутствуют любовные отношения разной степени близости, в зависимости от возраста целевой аудитории, большое внимание уделяется развитию образов персонажей. Как характерные черты можно отметить: преувеличенная условность рисунка (гротеско-юмористическая) или же, наоборот, утончённо-романтическая. Герои мужского пола выделяются внешними данными. Поджанром сёдзё является махо-сёдзё, рассказывающий о приключениях девочек, наделённых магической силой (например, «Сейлор Мун»)</p>
        </div>
        
        <!-- Блок с изображением - справа -->
        <div class="col-md-6 order-md-2 order-1 mb-4 mb-md-0">
            <div class="image-block text-center">
              <img src="{{ asset('img/sailor_moon.jpeg') }}" 
                   alt="sailor moon" 
                   class="img-fluid rounded shadow-sm mx-auto d-block"
                   style="max-height: 400px; object-fit: contain;">
              <p class="mt-3 mx-auto" style="max-width: 80%;">
                Прекрасная воительница Сейлор Мун (1992 г.)
              </p>
            </div>
          </div>
      </div>
    </div>
  </section>
  <section class="genre2 py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Блок с изображением - слева -->
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="image-block text-center">
              <img src="{{ asset('img/paradisekiss.jpg') }}" 
                   alt="райский поцелуй" 
                   class="img-fluid rounded shadow-sm mx-auto d-block"
                   style="max-height: 400px; object-fit: contain;">
              <p class="mt-3 mx-auto" style="max-width: 80%;">
                Paradise kiss (в пер. “Райский поцелуй”) - манга, выпускаемая с 2000 по 2003 года
              </p>
            </div>
          </div>
        
        <!-- Текстовый блок - справа -->
        <div class="col-md-6">
          <p class="mb-0 fs-5 text-center">Дзёсэй — аниме или манга для женщин. Сюжет чаще всего описывает повседневную жизнь женщины, живущей в Японии. Как правило, часть повествования отводится под события из школьной жизни главной героини (именно в это время она знакомится с другими действующими лицами и происходит завязка сюжета). Стиль рисунка, используемый в дзёсэе, немного более реалистичен, чем в сёдзё, однако сохраняет в себе некоторые его характерные особенности. Опять-таки, в отличие от сёдзё, любовные отношения изображены в дзёсэе намного более проработанно (Paradise Kiss, Honey and Clover).</p>
        </div>
      </div>
    </div>
  </section>
<h2 class="text-center mb-4">Жанры манги по сеттингу</h2>
<h3 class="text-center mb-4">Здесь представлены самые популярные жанры манги, которые существуют.</h3>
<ul class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 g-md-4 list-unstyled mb-5">
    <li class="col">
        <div class="card-item p-3 h-100">
            <p class="mb-0">Аполалиптика - разновидность манги и аниме, повествующая о наступлении конце света.</p>
        </div>
    </li>
    <li class="col">
        <div class="card-item p-3 h-100">
            <p class="mb-0">Боевые искусства - жанр манги и аниме, связанный с противостоянием мастеров различных боевых исскуств.</p>
        </div>
    </li>
    <li class="col">
        <div class="card-item p-3 h-100">
            <p class="mb-0">Идолы — аниме, действие которого связано с поп-звездами и музыкальным бизнесом.</p>
        </div>
    </li>
    <li class="col">
        <div class="card-item p-3 h-100">
            <p class="mb-0">Киберпанк — жанр, рассказывающий о мире будущего, в котором жизнь определяют компьютерные технологии. Часто картины такого будущего представлены мрачными и антиутопическими.</p>
        </div>
    </li>
    <li class="col">
        <div class="card-item p-3 h-100">
            <p class="mb-0">Комедия — жанр, характеризующийся наличием юмористических сцен, в том числе пародий, комедии положений, словесных и прикладных шуток.</p>
        </div>
    </li>
    <li class="col">
        <div class="card-item p-3 h-100">
            <p class="mb-0">Повседневность — жанр, повествующий о жизни обычных людей, чаще всего японцев среднего класса.</p>
        </div>
    </li>
    <li class="col">
        <div class="card-item p-3 h-100">
            <p class="mb-0">Постапокалиптика — разновидность аниме и манги, повествующая о жизни после конца света.</p>
        </div>
    </li>
    <li class="col">
        <div class="card-item p-3 h-100">
            <p class="mb-0">Романтика — жанр, повествующий о любовных переживаниях.</p>
        </div>
    </li>
</ul>
</main>
@endsection