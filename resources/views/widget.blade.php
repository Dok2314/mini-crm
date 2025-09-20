<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Widget</title>
    <link rel="stylesheet" href="{{ asset('widgets/widget.css') }}">
</head>
<body>
<form id="widget-form" data-api-url="{{ route('api.tickets.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="name">Имя</label>
    <input type="text" id="name" name="name" required>

    <label for="phone">Телефон</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="subject">Тема</label>
    <input type="text" id="subject" name="subject" required>

    <label for="message">Сообщение</label>
    <textarea id="message" name="message" required></textarea>

    <label for="files">Файлы (можно несколько)</label>
    <input type="file" id="files" name="files[]" multiple>

    <button type="submit">Отправить</button>
</form>

<div id="widget-response"></div>
<script src="{{ asset('widgets/widget.js') }}" defer></script>
</body>
</html>
