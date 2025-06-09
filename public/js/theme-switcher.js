document.addEventListener('DOMContentLoaded', function () {
    const toggleSwitch = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Применение текущей темы при загрузке страницы
    applyTheme(currentTheme);
    toggleSwitch.checked = currentTheme === 'dark';

    toggleSwitch.addEventListener('change', function () {
        const newTheme = this.checked ? 'dark' : 'light';
        applyTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    });

    function applyTheme(theme) {
        const body = document.body;
        const elements = [body, document.querySelector('header'), document.querySelector('footer'), ...document.querySelectorAll('form')];

        elements.forEach((el) => {
            if (el) {
                el.classList.remove('dark-theme', 'light-theme');
                el.classList.add(`${theme}-theme`);
            }
        });
    }
});

