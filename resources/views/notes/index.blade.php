@extends('layouts.notes')

@section('content')
<div class="mx-auto max-w-7xl py-2 sm:py-4">
    <div class="ui-surface mb-6 p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Заметки</h1>
            </div>
            <a href="{{ route('notes.create') }}" class="ui-btn-primary">Новая заметка</a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('notes.index') }}" class="ui-surface mb-6 p-4">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="w-full lg:max-w-md">
                <input type="text" name="q" value="{{ $q }}" placeholder="Поиск по заголовку..." class="ui-input" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-slate-500">Колонки:</span>
                @foreach([2,3,4] as $option)
                    <button type="submit" name="cols" value="{{ $option }}" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border px-3 text-sm font-medium transition {{ $cols === $option ? 'border-slate-900 bg-slate-900 text-white shadow-sm' : 'border-slate-300 bg-white text-slate-700 hover:border-slate-400 hover:bg-slate-50' }}">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>
    </form>

    <div @class([
        'mb-8 grid gap-5',
        'grid-cols-1 sm:grid-cols-2' => $cols === 2,
        'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3' => $cols === 3,
        'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4' => $cols === 4,
    ])>
        @forelse($notes as $note)
        <article style="border-top: 3px solid {{ $note->color }}" class="group flex min-h-[220px] flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-900/5 transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-900/10">
            <div class="mb-3 flex items-start justify-between gap-3">
                <h2 class="break-words text-lg font-semibold text-slate-900">{{ $note->title }}</h2>
                <form method="POST" action="{{ route('notes.toggle-pin', $note->id) }}">
                    @csrf
                    <button type="submit" class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-lg leading-none transition hover:scale-110 {{ $note->is_pinned ? 'bg-amber-100 text-amber-600' : 'text-slate-400 hover:bg-slate-100 hover:text-slate-600' }}" aria-label="{{ $note->is_pinned ? 'Открепить заметку' : 'Закрепить заметку' }}" title="{{ $note->is_pinned ? 'Открепить' : 'Закрепить' }}">
                        <span aria-hidden="true">📌</span>
                    </button>
                </form>
            </div>

            @if($note->is_pinned)
            <div class="mb-3">
                <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700">Закреплено</span>
            </div>
            @endif

            @if($note->content)
            <p class="mb-5 line-clamp-4 text-sm leading-6 text-slate-600">{{ $note->content }}</p>
            @else
            <p class="mb-5 text-sm italic text-slate-400">Без описания</p>
            @endif

            <div class="mt-auto flex gap-2">
                <a href="{{ route('notes.edit', $note->id) }}" class="ui-btn-secondary flex-1 py-2 text-center">Редактировать</a>
                <form method="POST" action="{{ route('notes.destroy', $note->id) }}" class="flex-1" onsubmit="return confirm('Удалить заметку?')">
                    @csrf
                    <button type="submit" class="ui-btn-danger w-full py-2">Удалить</button>
                </form>
            </div>
        </article>
        @empty
        <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white py-14 text-center">
            <p class="text-base font-medium text-slate-700">Пока нет заметок</p>
        </div>
        @endforelse
    </div>

    <div class="ui-surface overflow-hidden px-2 py-2 sm:px-4 sm:py-3">
        {{ $notes->onEachSide(1)->links() }}
    </div>
</div>
@endsection