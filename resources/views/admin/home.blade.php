<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мини-CRM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-6">
@auth
    @include('includes.nav')

    <main class="mt-6">
        <p>Добро пожаловать! Выберите раздел в меню.</p>
    </main>
@else
    <main class="mt-6">
        <p>Пожалуйста, <a href="{{ route('login') }}" class="text-blue-600 hover:underline">войдите</a> в систему для доступа к админке.</p>
    </main>
@endauth
</body>
</html>
