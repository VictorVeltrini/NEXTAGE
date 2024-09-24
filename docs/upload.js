document.addEventListener('DOMContentLoaded', () => {
    const themeButton = document.getElementById('theme-button');
    themeButton.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        themeButton.textContent = document.body.classList.contains('dark') ? 'Modo Claro' : 'Modo Escuro';
    });
});