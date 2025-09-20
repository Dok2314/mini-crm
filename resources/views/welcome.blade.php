<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-6">
<header>
    <h1>Мини-CRM</h1>
    <nav>
        <ul>
            <li><a href="{{ route('admin.tickets.index') }}">Заявки</a></li>
            <li><a href="{{ route('admin.customers.index') }}">Клиенты</a></li>
            <li><a href="{{ route('widget') }}" target="_blank">Виджет</a></li>
        </ul>
    </nav>
</header>

<main class="mt-6">
    <p>Добро пожаловать! Выберите раздел в меню.</p>
</main>
</body>
</html>
