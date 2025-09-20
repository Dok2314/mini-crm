<header class="flex justify-between items-center bg-gray-100 px-6 py-4 shadow">
    <nav class="flex gap-4">
        <a href="{{ route('admin.tickets.index') }}" class="text-blue-600 hover:underline">Заявки</a>
        <a href="{{ route('admin.customers.index') }}" class="text-blue-600 hover:underline">Клиенты</a>
        <a href="{{ route('widget') }}" target="_blank" class="text-blue-600 hover:underline">Виджет</a>
    </nav>

    @auth
        <div class="flex items-center gap-4">
            <span>Привет, {{ auth()->user()->name }}!</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Выйти</button>
            </form>
        </div>
    @endauth
</header>
