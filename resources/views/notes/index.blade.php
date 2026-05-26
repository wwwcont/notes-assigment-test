@extends('layouts.notes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold">Заметки</h1>
        <a href="{{ route('notes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">+ Новая</a>
    </div>

    <form method="GET" action="{{ route('notes.index') }}" class="mb-6">
        <input type="text" name="q" value="{{ $q }}" placeholder="Поиск..." class="w-full px-4 py-2 border rounded">
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @forelse($notes as $note)
        <div style="border-top: 4px solid {{ $note->color }}" class="bg-white rounded shadow p-4">
            <div class="flex justify-between items-start mb-3">
                <h2 class="font-bold text-lg">{{ $note->title }}</h2>
                @if($note->is_pinned)
                <span class="ml-2">📌</span>
                @endif
            </div>

            @if($note->content)
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $note->content }}</p>
            @endif

            <div class="flex gap-2 mt-4">
                <a href="{{ route('notes.edit', $note) }}" class="flex-1 bg-gray-100 text-center py-2 rounded text-sm hover:bg-gray-200">Редактировать</a>
                <form method="POST" action="{{ route('notes.destroy', $note) }}" class="flex-1" onsubmit="return confirm('Удалить?')">
                    @csrf
                    <button type="submit" class="w-full bg-red-100 text-red-700 py-2 rounded text-sm hover:bg-red-200">Удалить</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-500 py-8">Нет заметок</div>
        @endforelse
    </div>

    {{ $notes->links() }}
</div>
@endsection
