@extends('admin.home')

@section('content')
    <h2>Список заявок</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Тема</th>
            <th>Статус</th>
            <th>Создано</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->customer->name }}</td>
                <td>{{ $ticket->subject }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->created_at }}</td>
                <td>
                    <a href="{{ route('admin.tickets.show', $ticket) }}">Просмотр</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}
@endsection
