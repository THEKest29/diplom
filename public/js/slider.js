document.addEventListener('DOMContentLoaded', function() {
    const images = [
        'attack_on_titan.jpg',
        'chainsawman.jpg',
        'jujutsu_kaisen.jpg',
        'solo_leveling.jpg',
        'Doraemon_2005.jpg',
        'sailor_moon.jpeg'
    ];
    
    const carousel = document.getElementById('responsiveCarousel');
    const carouselInner = carousel.querySelector('.carousel-inner');
    
    // Функция для создания карусели
    function initCarousel() {
        const isMobile = window.innerWidth < 768;
        carouselInner.innerHTML = '';
        
        // Создаем слайды (по одному на каждый элемент)
        images.forEach((img, index) => {
            const activeClass = index === 0 ? 'active' : '';
            const item = document.createElement('div');
            item.className = `carousel-item ${activeClass}`;
            
            const row = document.createElement('div');
            row.className = 'row carousel-item-row';
            
            // Добавляем текущий слайд + 2 следующих (для десктопа)
            for (let i = 0; i < (isMobile ? 1 : 3); i++) {
                const imgIndex = (index + i) % images.length;
                const col = document.createElement('div');
                col.className = isMobile ? 'col-12' : 'col-md-4';
                
                const imgEl = document.createElement('img');
                imgEl.src = `img/${images[imgIndex]}`;
                imgEl.className = 'd-block';
                imgEl.alt = images[imgIndex].split('.')[0].replace(/_/g, ' ');
                
                col.appendChild(imgEl);
                row.appendChild(col);
            }
            
            item.appendChild(row);
            carouselInner.appendChild(item);
        });
        
        // Переинициализируем карусель
        const bsCarousel = bootstrap.Carousel.getInstance(carousel) || 
                          new bootstrap.Carousel(carousel, {
                              interval: false,
                              wrap: true
                          });
        
        // Для десктопной версии корректируем отображение
        if (!isMobile) {
            updateDesktopView();
        }
    }
    
    // Функция для обновления видимых слайдов в десктопной версии
    function updateDesktopView() {
        const activeIndex = getActiveIndex();
        const items = carouselInner.querySelectorAll('.carousel-item');
        
        items.forEach((item, index) => {
            const row = item.querySelector('.row');
            row.innerHTML = '';
            
            // Добавляем текущий слайд + 2 следующих
            for (let i = 0; i < 3; i++) {
                const imgIndex = (index + i) % images.length;
                const col = document.createElement('div');
                col.className = 'col-md-4';
                
                const imgEl = document.createElement('img');
                imgEl.src = `img/${images[imgIndex]}`;
                imgEl.className = 'd-block';
                imgEl.alt = images[imgIndex].split('.')[0].replace(/_/g, ' ');
                
                col.appendChild(imgEl);
                row.appendChild(col);
            }
        });
        
        // Возвращаемся к активному слайду
        const bsCarousel = bootstrap.Carousel.getInstance(carousel);
        bsCarousel.to(activeIndex);
    }
    
    // Получаем текущий активный индекс
    function getActiveIndex() {
        const activeItem = carouselInner.querySelector('.carousel-item.active');
        return Array.from(carouselInner.children).indexOf(activeItem);
    }
    
    // Обработчик изменения размера окна
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            const wasMobile = carouselInner.querySelector('.col-12') !== null;
            const isMobile = window.innerWidth < 768;
            
            if (wasMobile !== isMobile) {
                initCarousel();
            } else if (!isMobile) {
                updateDesktopView();
            }
        }, 100);
    });
    
    // Инициализация при загрузке
    initCarousel();
});