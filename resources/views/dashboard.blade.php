<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Мини-CRM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <nav class="mb-6">
                    <ul class="flex space-x-4">
                        <li><a href="{{ route('admin.tickets.index') }}" class="text-indigo-600 hover:text-indigo-800">Заявки</a></li>
                        <li><a href="{{ route('admin.customers.index') }}" class="text-indigo-600 hover:text-indigo-800">Клиенты</a></li>
                        <li><a href="{{ route('widget') }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">Виджет</a></li>
                    </ul>
                </nav>

                <p class="text-gray-700 dark:text-gray-300">Добро пожаловать! Выберите раздел в меню.</p>
            </div>
        </div>
    </div>
</x-app-layout>
