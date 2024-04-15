import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.getElementById('searchInput').addEventListener('input', function () {
    const form = document.getElementById('liveSearchForm');
    const formData = new FormData(form);  // Создаем объект FormData

    fetch(form.action, {
        method: 'POST',  // Убеждаемся, что метод POST используется
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',  // Для обработки запроса как AJAX
            'X-CSRF-TOKEN': formData.get('_token')  // Получаем CSRF токен из формы
        }
    })
        .then(response => response.text())  // Обработка ответа как текст
        .then(html => {
            document.getElementById('searchResults').innerHTML = html;  // Вставка HTML в элемент searchResults
        })
        .catch(error => console.error('Error:', error));
});

