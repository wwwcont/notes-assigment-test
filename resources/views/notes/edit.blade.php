@extends('layouts.notes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Редактировать заметку</h1>

    <form method="POST" action="{{ route('notes.update', $note) }}" class="max-w-2xl" x-data="{ selectedColor: '{{ old('color', $note->color) }}' }">
        @csrf

        <div class="mb-6">
            <label for="title" class="block text-sm font-bold mb-2">Заголовок</label>
            <input id="title" type="text" name="title" value="{{ old('title', $note->title) }}" class="w-full px-4 py-2 border rounded @error('title') border-red-500 @enderror" maxlength="255" required>
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-bold mb-2">Содержимое</label>
            <textarea id="content" name="content" rows="8" class="w-full px-4 py-2 border rounded @error('content') border-red-500 @enderror">{{ old('content', $note->content) }}</textarea>
            @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <span class="block text-sm font-bold mb-3">Цвет</span>
            <div class="flex flex-wrap gap-3">
                @foreach(['#6366f1', '#ec4899', '#f59e0b', '#10b981', '#06b6d4', '#8b5cf6'] as $colorOption)
                <button
                    type="button"
                    @click="selectedColor = '{{ $colorOption }}'"
                    class="w-8 h-8 rounded-full border-2 transition"
                    :class="selectedColor === '{{ $colorOption }}' ? 'border-gray-900 scale-110' : 'border-transparent'"
                    style="background-color: {{ $colorOption }}"
                    aria-label="Выбрать цвет {{ $colorOption }}"
                ></button>
                @endforeach
            </div>
            <input type="hidden" name="color" :value="selectedColor">
            @error('color')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Сохранить</button>
            <a href="{{ route('notes.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Отмена</a>
        </div>
    </form>
</div>
@endsection