@extends('layouts.notes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-3xl font-bold">Заметки</h1>
        <a href="{{ route('notes.create') }}" class="inline-flex items-center justify-center bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Новая</a>
    </div>

    @if(session('success'))
    <div class="mb-6 rounded-md border border-green-200 bg-green-50 text-green-800 px-4 py-2">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('notes.index') }}" class="mb-6">
        <input type="text" name="q" value="{{ $q }}" placeholder="Поиск по заголовку..." class="w-full px-4 py-2 border rounded" />
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @forelse($notes as $note)
        <article
            x-data="{ isPinned: @js($note->is_pinned), loading: false }"
            style="border-top: 4px solid {{ $note->color }}"
            class="bg-white rounded-lg shadow p-4"
        >
            <div class="flex justify-between items-start mb-3 gap-3">
                <h2 class="font-bold text-lg break-words">{{ $note->title }}</h2>

                <button
                    type="button"
                    class="shrink-0 rounded px-2 py-1 text-lg hover:bg-gray-100 disabled:opacity-50"
                    :disabled="loading"
                    :aria-label="isPinned ? 'Открепить заметку' : 'Закрепить заметку'"
                    @click="
                        loading = true;
                        fetch('{{ route('notes.toggle-pin', $note) }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(async (response) => {
                            if (!response.ok) {
                                throw new Error('Request failed');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            isPinned = data.is_pinned;
                        })
                        .finally(() => {
                            loading = false;
                        });
                    "
                >
                    <span x-text="isPinned ? '📌' : '📍'"></span>
                </button>
            </div>

            @if($note->content)
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $note->content }}</p>
            @endif

            <div class="flex gap-2 mt-4">
                <a href="{{ route('notes.edit', $note) }}" class="flex-1 bg-gray-100 text-center py-2 rounded text-sm hover:bg-gray-200">Редактировать</a>
                <form method="POST" action="{{ route('notes.destroy', $note) }}" class="flex-1" onsubmit="return confirm('Удалить заметку?')">
                    @csrf
                    <button type="submit" class="w-full bg-red-100 text-red-700 py-2 rounded text-sm hover:bg-red-200">Удалить</button>
                </form>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center text-gray-500 py-10">Нет заметок</div>
        @endforelse
    </div>

    {{ $notes->links() }}
</div>
@endsection