@extends('layouts.notes')

@section('content')
<div class="mx-auto max-w-3xl py-4 sm:py-8">
    <div class="ui-surface p-6 sm:p-8">
        <h1 class="mb-1 text-2xl font-semibold tracking-tight text-slate-900">Редактировать заметку</h1>
        <p class="mb-6 text-sm text-slate-500">Обновите содержимое и внешний вид заметки.</p>

        <form method="POST" action="{{ route('notes.update', $note) }}" class="space-y-5">
            @csrf
            <div>
                <label for="title" class="mb-2 block text-sm font-medium text-slate-700">Заголовок</label>
                <input id="title" type="text" name="title" value="{{ old('title', $note->title) }}" class="ui-input @error('title') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror" maxlength="255" required>
                @error('title')<p class="mt-1 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="content" class="mb-2 block text-sm font-medium text-slate-700">Содержимое</label>
                <textarea id="content" name="content" rows="8" class="ui-input @error('content') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror">{{ old('content', $note->content) }}</textarea>
                @error('content')<p class="mt-1 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <span class="mb-3 block text-sm font-medium text-slate-700">Цвет</span>
                <div class="flex flex-wrap gap-3">
                    @foreach(['#6366f1', '#ec4899', '#f59e0b', '#10b981', '#06b6d4', '#8b5cf6'] as $colorOption)
                    <label class="cursor-pointer">
                        <input type="radio" name="color" value="{{ $colorOption }}" class="peer sr-only" {{ old('color', $note->color) === $colorOption ? 'checked' : '' }}>
                        <span class="block h-10 w-10 rounded-full ring-2 ring-transparent shadow-sm transition duration-200 hover:scale-105 peer-checked:scale-110 peer-checked:ring-slate-900" style="background-color: {{ $colorOption }}"></span>
                    </label>
                    @endforeach
                </div>
                @error('color')<p class="mt-1 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex flex-wrap gap-2 pt-2">
                <button type="submit" class="ui-btn-primary">Сохранить</button>
                <a href="{{ route('notes.index') }}" class="ui-btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection