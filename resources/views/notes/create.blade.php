@extends('layouts.notes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Новая заметка</h1>

    <form method="POST" action="{{ route('notes.store') }}" class="max-w-2xl">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">Название</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-2 border rounded @error('title') border-red-500 @enderror">
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">Содержимое</label>
            <textarea name="content" rows="8" class="w-full px-4 py-2 border rounded @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
            @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold mb-3">Цвет</label>
            <div class="flex gap-3">
                @foreach(['#6366f1', '#ec4899', '#f59e0b', '#10b981', '#06b6d4', '#8b5cf6'] as $colorOption)
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="color" value="{{ $colorOption }}" @checked(old('color', '#6366f1') === $colorOption) class="hidden">
                    <div class="w-8 h-8 rounded-full" style="background-color: {{ $colorOption }};@checked(old('color', '#6366f1') === $colorOption) ring: 2px; ring-color: #000;@endchecked"></div>
                </label>
                @endforeach
            </div>
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
