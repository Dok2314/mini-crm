@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-1">Список заявок</h2>
    <p class="text-sm text-gray-600 mb-4">
        Можно сортировать по полям: <strong>ID, Тема, Статус, Дата</strong>
    </p>

    <form method="GET" action="{{ route('admin.tickets.index') }}" class="mb-4 flex gap-2 flex-wrap">
        <label>
            <input type="text" name="email" placeholder="Email" value="{{ request('email') }}" class="border px-2 py-1 rounded">
        </label>
        <label>
            <input type="text" name="phone" placeholder="Телефон" value="{{ request('phone') }}" class="border px-2 py-1 rounded">
        </label>

        <label>
            <select name="status" class="border px-2 py-1 rounded">
                <option value="">Все статусы</option>
                @foreach(\App\Enums\TicketStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected(request('status') == $status->value)>{{ $status->label() }}</option>
                @endforeach
            </select>
        </label>

        <label>
            <input type="date" name="from" value="{{ request('from') }}" class="border px-2 py-1 rounded" placeholder="С">
        </label>
        <label>
            <input type="date" name="to" value="{{ request('to') }}" class="border px-2 py-1 rounded" placeholder="По">
        </label>

        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Фильтровать</button>
        <a href="{{ route('admin.tickets.index') }}" class="px-3 py-1 border rounded">Сбросить</a>
    </form>


    <table class="w-full border border-gray-300 mb-4">
        <thead>
        <tr class="bg-gray-200">
            <th class="border px-2 py-1">
                <a href="{{ route('admin.tickets.index', array_merge(request()->all(), ['sort_by' => 'id', 'sort_order' => ($sortBy === 'id' && $sortOrder === 'asc') ? 'desc' : 'asc'])) }}">
                    ID @if($sortBy === 'id') {{ $sortOrder === 'asc' ? '↑' : '↓' }} @endif
                </a>
            </th>
            <th class="border px-2 py-1">Клиент</th>
            <th class="border px-2 py-1">Email</th>
            <th class="border px-2 py-1">Телефон</th>
            <th class="border px-2 py-1">
                <a href="{{ route('admin.tickets.index', array_merge(request()->all(), ['sort_by' => 'subject', 'sort_order' => ($sortBy === 'subject' && $sortOrder === 'asc') ? 'desc' : 'asc'])) }}">
                    Тема @if($sortBy === 'subject') {{ $sortOrder === 'asc' ? '↑' : '↓' }} @endif
                </a>
            </th>
            <th class="border px-2 py-1">
                <a href="{{ route('admin.tickets.index', array_merge(request()->all(), ['sort_by' => 'status', 'sort_order' => ($sortBy === 'status' && $sortOrder === 'asc') ? 'desc' : 'asc'])) }}">
                    Статус @if($sortBy === 'status') {{ $sortOrder === 'asc' ? '↑' : '↓' }} @endif
                </a>
            </th>
            <th class="border px-2 py-1">
                <a href="{{ route('admin.tickets.index', array_merge(request()->all(), ['sort_by' => 'created_at', 'sort_order' => ($sortBy === 'created_at' && $sortOrder === 'asc') ? 'desc' : 'asc'])) }}">
                    Дата @if($sortBy === 'created_at') {{ $sortOrder === 'asc' ? '↑' : '↓' }} @endif
                </a>
            </th>
            <th class="border px-2 py-1">Детали</th>
        </tr>
        </thead>

        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td class="border px-2 py-1">{{ $ticket->id }}</td>
                <td class="border px-2 py-1">{{ $ticket->customer->name }}</td>
                <td class="border px-2 py-1">{{ $ticket->customer->email }}</td>
                <td class="border px-2 py-1">{{ $ticket->customer->phone }}</td>
                <td class="border px-2 py-1">{{ $ticket->subject }}</td>
                <td class="border px-2 py-1">{{ \App\Enums\TicketStatus::from($ticket->status)->label() }}</td>
                <td class="border px-2 py-1">{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                <td class="border px-2 py-1"><a href="{{ route('admin.tickets.show', $ticket) }}" class="text-blue-600 hover:underline">Просмотр</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-2">
        {{ $tickets->links() }}
    </div>
@endsection
