@extends('layouts.app')
@section('content')
<main class="main-page">
<h1 class="text-center">История возникновения и развития манги</h1>
<div class="image-block text-center">
    <img src="{{ asset('img/Wikipe-tan_manga_page1.jpg') }}" 
         alt="Википа-тян" 
         class="img-fluid rounded shadow-sm mx-auto d-block"
         style="max-height: 400px; object-fit: contain;">
    <p class="mt-3 mx-auto" style="max-width: 80%;">
        Страница из манги о Википе-тан — неофициальном маскоте Википедии
    </p>
  </div>
<h2 class="text-center mb-4">Древние корни</h2>
<section class="genre1 py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Текстовый блок - слева -->
        <div class="col-md-6 order-md-1 order-2">
          <p class="mb-md-0 fs-5 text-center">Манга берет свое начало еще в 12 веке, когда монахи создавали иллюстрированные свитки (например, "Чоджю-гига") для передачи историй и знаний. Эти свитки могут быть считаны предшественниками современной манги.</p>
        </div>
        
        <!-- Блок с изображением - справа -->
        <div class="col-md-6 order-md-2 order-1 mb-4 mb-md-0">
            <div class="image-block text-center">
              <img src="{{ asset('img/250px-Chouju_sumo2.jpg') }}" 
                   alt="Чоуджу_сумо" 
                   class="img-fluid rounded shadow-sm mx-auto d-block"
                   style="max-height: 400px; object-fit: contain;">
              <p class="mt-3 mx-auto" style="max-width: 80%;">
                Животные соревнуются в борьбе сумо
              </p>
            </div>
          </div>
      </div>
    </div>
  </section>
  <h2 class="text-center mb-4">Эдо и Мэйдзи</h2>
  <section class="genre2 py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Блок с изображением - слева -->
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="image-block text-center">
              <img src="{{ asset('img/Ukiyo-e_dsc04680.jpg') }}" 
                   alt="Эдо и Мэйдзи" 
                   class="img-fluid rounded shadow-sm mx-auto d-block"
                   style="max-height: 400px; object-fit: contain;">
              <p class="mt-3 mx-auto" style="max-width: 80%;">
                Печатная форма в процессе исготовления
              </p>
            </div>
          </div>
        
        <!-- Текстовый блок - справа -->
        <div class="col-md-6">
          <p class="mb-0 fs-5 text-center">В эпоху Эдо (1603-1868) появилась популярная культура "укиё-э", или "картины плавающего мира". Художники создавали цветные гравюры, которые изображали сцены из повседневной жизни, природы и театра. В этот период начали появляться и ранние версии манги.</p>
        </div>
      </div>
    </div>
  </section>
  <h2 class="text-center mb-4">20 век и Осаму Тедзука</h2>
  <section class="genre1 py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Текстовый блок - слева -->
        <div class="col-md-6 order-md-1 order-2">
          <p class="mb-md-0 fs-5 text-center">Современная манга, какой мы ее знаем, начала формироваться в середине 20-го века. Большую роль в этом сыграл Осаму Тэдзука, которого часто называют "отцом манги". Его работы, такие как "Астробой" и "Чёрный Джек", заложили основы для многих жанров и стилей манги.</p>
        </div>
        
        <!-- Блок с изображением - справа -->
        <div class="col-md-6 order-md-2 order-1 mb-4 mb-md-0">
            <div class="image-block text-center">
              <img src="{{ asset('img/astroboy.jpg') }}" 
                   alt="астробой" 
                   class="img-fluid rounded shadow-sm mx-auto d-block"
                   style="max-height: 400px; object-fit: contain;">
              <p class="mt-3 mx-auto" style="max-width: 80%;">
                Астробой
              </p>
            </div>
          </div>
      </div>
    </div>
  </section>
  <h2 class="text-center mb-4">Послевоенные и современные годы</h2>
  <section class="genre2 py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Блок с изображением - слева -->
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="image-block text-center">
              <img src="{{ asset('img/640px-Shonen_Jump_Japan.jpg') }}" 
                   alt="shonen jump" 
                   class="img-fluid rounded shadow-sm mx-auto d-block"
                   style="max-height: 400px; object-fit: contain;">
              <p class="mt-3 mx-auto" style="max-width: 80%;">
                Журнал манги “Weekly Shonen Jump”
              </p>
            </div>
          </div>
        
        <!-- Текстовый блок - справа -->
        <div class="col-md-6">
          <p class="mb-0 fs-5 text-center">После Второй мировой войны манга стала еще более популярной. В 1950-е и 1960-е годы возникли множество манга-журналов, таких как "Shonen Jump" и "Shojo Beat". Каждый журнал был ориентирован на определенные возрастные и гендерные группы, что способствовало разнообразию жанров и тем.</p>
        </div>
      </div>
    </div>
  </section>
  <section class="about-manga py-5">
    <div class="container">
      <div class="row justify-content-center">
          <h2 class="text-center mb-4">Современность</h2>
          <p class="lead">
            Сегодня манга является важной частью японской культуры и имеет огромную международную популярность. Манга охватывает широкий спектр жанров и тем, от приключений и фэнтези до романтики и драмы. Она вдохновляет аниме, фильмы и видеоигры и имеет преданных поклонников по всему миру.
          </p>
      </div>
    </div>
  </section>
</main>
@endsection