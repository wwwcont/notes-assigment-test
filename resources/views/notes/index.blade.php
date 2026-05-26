@extends('layouts.notes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8 rounded-2xl bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 p-6 text-white shadow-lg">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold">Заметки</h1>
            </div>
            <a href="{{ route('notes.create') }}" class="inline-flex items-center justify-center rounded-lg bg-white px-4 py-2 font-medium text-indigo-700 transition hover:bg-indigo-50">+ Новая заметка</a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 rounded-md border border-green-200 bg-green-50 px-4 py-2 text-green-800">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('notes.index') }}" class="mb-6">
        <input type="text" name="q" value="{{ $q }}" placeholder="Поиск по заголовку..." class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100" />
    </form>

    <div class="mb-6 grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-4">
        @forelse($notes as $note)
        <article
            x-data="{ isPinned: @js($note->is_pinned), loading: false, error: '' }"
            style="border-top: 4px solid {{ $note->color }}"
            class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-0.5 hover:shadow-md"
        >
            <div class="mb-3 flex items-start justify-between gap-3">
                <h2 class="break-words text-lg font-bold">{{ $note->title }}</h2>

                <button
                    type="button"
                    class="inline-flex shrink-0 items-center gap-1 rounded-full border border-amber-300 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700 transition hover:bg-amber-100 disabled:opacity-50"
                    :disabled="loading"
                    :aria-label="isPinned ? 'Открепить заметку' : 'Закрепить заметку'"
                    @click="
                        error = '';
                        loading = true;
                        fetch('{{ route('notes.toggle-pin', $note->id) }}', {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: new URLSearchParams({ _token: document.querySelector('meta[name=csrf-token]').content })
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
                        .catch(() => {
                            error = 'Не удалось обновить pin. Попробуйте ещё раз.';
                        })
                        .finally(() => {
                            loading = false;
                        });
                    "
                >
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M14.7 2.3a1 1 0 0 1 1.4 1.4l-1.5 1.5 1.6 4.8a1 1 0 0 1-.24 1.02l-2.12 2.12 1.06 3.18a1 1 0 0 1-1.66 1.02L9.9 14l-3.07 3.07a1 1 0 0 1-1.42-1.42L8.48 12.6 5 9.12a1 1 0 0 1 1.02-1.66l3.18 1.06 2.12-2.12a1 1 0 0 1 1.02-.24l4.8 1.6 1.56-1.46z"/>
                    </svg>
                    <span x-text="isPinned ? 'Закреплена' : 'Закрепить'"></span>
                </button>
            </div>

            <div class="mb-2" x-show="isPinned">
                <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-1 text-xs font-medium text-amber-800">📌 Закреплено</span>
            </div>

            <p x-show="error" x-text="error" class="mb-2 text-xs text-red-600"></p>

            @if($note->content)
            <p class="mb-4 line-clamp-3 text-sm text-gray-600">{{ $note->content }}</p>
            @endif

            <div class="mt-4 flex gap-2">
                <a href="{{ route('notes.edit', $note->id) }}" class="flex-1 rounded-lg bg-gray-100 py-2 text-center text-sm font-medium text-gray-700 transition hover:bg-gray-200">Редактировать</a>
                <form method="POST" action="{{ route('notes.destroy', $note->id) }}" class="flex-1" onsubmit="return confirm('Удалить заметку?')">
                    @csrf
                    <button type="submit" class="w-full rounded-lg bg-red-100 py-2 text-sm font-medium text-red-700 transition hover:bg-red-200">Удалить</button>
                </form>
            </div>
        </article>
        @empty
        <div class="col-span-full py-10 text-center text-gray-500">Нет заметок</div>
        @endforelse
    </div>

    {{ $notes->links() }}
</div>
@endsection