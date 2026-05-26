@extends('layouts.notes')

@section('content')
<div class="mx-auto max-w-3xl py-6">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <h1 class="mb-6 text-2xl font-semibold tracking-tight text-gray-900">Новая заметка</h1>

        <form method="POST" action="{{ route('notes.store') }}">
            @csrf

            <div class="mb-5">
                <label class="mb-2 block text-sm font-medium text-gray-700">Название</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-200 @error('title') border-red-500 @enderror">
                @error('title')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label class="mb-2 block text-sm font-medium text-gray-700">Содержимое</label>
                <textarea name="content" rows="8" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-200 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                @error('content')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="mb-3 block text-sm font-medium text-gray-700">Цвет</label>
                <div class="flex flex-wrap gap-3">
                    @foreach(['#6366f1', '#ec4899', '#f59e0b', '#10b981', '#06b6d4', '#8b5cf6'] as $colorOption)
                    <label class="cursor-pointer">
                        <input type="radio" name="color" value="{{ $colorOption }}" class="peer sr-only" {{ old('color', '#6366f1') === $colorOption ? 'checked' : '' }}>
                        <span class="block h-10 w-10 rounded-full border-2 border-transparent shadow-sm transition peer-checked:scale-110 peer-checked:border-gray-900" style="background-color: {{ $colorOption }}"></span>
                    </label>
                    @endforeach
                </div>
                @error('color')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-gray-700">Сохранить</button>
                <a href="{{ route('notes.index') }}" class="rounded-xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection