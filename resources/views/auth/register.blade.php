<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Регистрация</h1>
        <p class="mt-1 text-sm text-slate-500">Создайте аккаунт и начните вести заметки.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-3 pt-2">
            <x-primary-button class="w-full justify-center">{{ __('Register') }}</x-primary-button>
            <a class="text-center text-sm text-slate-600 transition hover:text-indigo-600" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
        </div>
    </form>
</x-guest-layout>