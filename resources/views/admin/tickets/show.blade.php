@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-xl font-semibold mb-4">Просмотр заявки #{{ $ticket->id }}</h2>

    <table class="w-full border border-gray-300 mb-4">
        <tr>
            <th class="border px-2 py-1">ID</th>
            <td class="border px-2 py-1">{{ $ticket->id }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1">Клиент</th>
            <td class="border px-2 py-1">{{ $ticket->customer->name }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1">Email</th>
            <td class="border px-2 py-1">{{ $ticket->customer->email }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1">Телефон</th>
            <td class="border px-2 py-1">{{ $ticket->customer->phone }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1">Тема</th>
            <td class="border px-2 py-1">{{ $ticket->subject }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1">Сообщение</th>
            <td class="border px-2 py-1">{{ $ticket->message }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1">Статус</th>
            <td class="border px-2 py-1">{{ \App\Enums\TicketStatus::from($ticket->status)->label() }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1">Дата создания</th>
            <td class="border px-2 py-1">{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
        </tr>
    </table>

    <form method="POST" action="{{ route('admin.tickets.changeStatus', $ticket) }}" class="mt-4 mb-6">
        @csrf
        <label for="status" class="block mb-1 font-medium">Сменить статус:</label>
        <select name="status" id="status" class="border px-2 py-1 rounded">
            @foreach(\App\Enums\TicketStatus::cases() as $status)
                <option value="{{ $status->value }}" @selected($ticket->status == $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
        <button type="submit" class="ml-2 bg-blue-600 text-white px-3 py-1 rounded">Сменить</button>
    </form>

    @if($ticket->hasMedia('files'))
        <h3 class="text-lg font-semibold mb-2">Файлы</h3>
        <ul class="list-disc list-inside mb-6">
            @foreach($ticket->getMedia('files') as $file)
                <li>
                    <a href="{{ route('tickets.file.download', [$ticket->id, $file->id]) }}" class="text-blue-600 hover:underline">
                        {{ $file->file_name }}
                    </a>
                    ({{ round($file->size / 1024, 2) }} KB)
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('admin.tickets.index') }}" class="text-blue-600 hover:underline">← Назад к списку заявок</a>
@endsection
