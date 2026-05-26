@extends('layouts.notes')

@section('content')
<div class="mx-auto py-6">
    <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight text-gray-900">Заметки</h1>
                <p class="mt-1 text-sm text-gray-500">Минималистичный список заметок с адаптивной сеткой.</p>
            </div>
            <a href="{{ route('notes.create') }}" class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-gray-700">Новая заметка</a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('notes.index') }}" class="mb-6 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="w-full lg:max-w-md">
                <input type="text" name="q" value="{{ $q }}" placeholder="Поиск по заголовку..." class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm shadow-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-200" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Колонки:</span>
                @foreach([2,3,4] as $option)
                    <button type="submit" name="cols" value="{{ $option }}" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border px-3 text-sm font-medium transition {{ $cols === $option ? 'border-gray-900 bg-gray-900 text-white' : 'border-gray-300 bg-white text-gray-700 hover:border-gray-400' }}">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>
    </form>

    @php
        $gridClass = match($cols) {
            2 => 'grid-cols-1 md:grid-cols-2',
            4 => 'grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4',
            default => 'grid-cols-1 sm:grid-cols-2 xl:grid-cols-3',
        };
    @endphp

    <div class="mb-8 grid {{ $gridClass }} gap-4">
        @forelse($notes as $note)
        <article style="border-top: 3px solid {{ $note->color }}" class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="mb-3 flex items-start justify-between gap-3">
                <h2 class="break-words text-lg font-semibold text-gray-900">{{ $note->title }}</h2>
                <form method="POST" action="{{ route('notes.toggle-pin', $note->id) }}">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full border transition {{ $note->is_pinned ? 'border-amber-300 bg-amber-50 text-amber-700 hover:bg-amber-100' : 'border-gray-300 bg-white text-gray-500 hover:bg-gray-100' }}"
                        aria-label="{{ $note->is_pinned ? 'Открепить заметку' : 'Закрепить заметку' }}"
                        title="{{ $note->is_pinned ? 'Открепить' : 'Закрепить' }}"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M14.7 2.3a1 1 0 0 1 1.4 1.4l-1.5 1.5 1.6 4.8a1 1 0 0 1-.24 1.02l-2.12 2.12 1.06 3.18a1 1 0 0 1-1.66 1.02L9.9 14l-3.07 3.07a1 1 0 0 1-1.42-1.42L8.48 12.6 5 9.12a1 1 0 0 1 1.02-1.66l3.18 1.06 2.12-2.12a1 1 0 0 1 1.02-.24l4.8 1.6 1.56-1.46z"/>
                        </svg>
                    </button>
                </form>
           </div>

            @if($note->is_pinned)
            <div class="mb-3">
                <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700">Закреплено</span>
            </div>
            @endif

            @if($note->content)
            <p class="mb-4 line-clamp-4 text-sm leading-6 text-gray-600">{{ $note->content }}</p>
            @endif

            <div class="mt-auto flex gap-2">
                <a href="{{ route('notes.edit', $note->id) }}" class="flex-1 rounded-lg border border-gray-300 bg-white py-2 text-center text-sm font-medium text-gray-700 transition hover:bg-gray-50">Редактировать</a>
                <form method="POST" action="{{ route('notes.destroy', $note->id) }}" class="flex-1" onsubmit="return confirm('Удалить заметку?')">
                    @csrf
                    <button type="submit" class="w-full rounded-lg border border-red-200 bg-red-50 py-2 text-sm font-medium text-red-700 transition hover:bg-red-100">Удалить</button>
                </form>
            </div>
        </article>
        @empty
        <div class="col-span-full rounded-2xl border border-dashed border-gray-300 bg-white py-12 text-center text-gray-500">Нет заметок</div>
        @endforelse
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
        {{ $notes->onEachSide(1)->links() }}
    </div>
</div>
@endsection