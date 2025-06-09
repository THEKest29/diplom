document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.menu');

    menuToggle.addEventListener('click', function() {
        if (window.innerWidth <= 768) { // Проверяем, что это мобильное устройство
            menu.classList.toggle('active');
        }
    });
});