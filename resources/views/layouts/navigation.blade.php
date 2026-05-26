<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-indigo-100 bg-white/90 backdrop-blur">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            <div class="flex items-center gap-3 sm:gap-6">
                <a href="{{ route('notes.index') }}" class="inline-flex items-center gap-2 rounded-lg px-2 py-1 text-lg font-bold text-indigo-700">
                    <span>📝</span><span>Notes</span>
                </a>
                <div class="hidden sm:flex sm:items-center sm:gap-2">
                    <x-nav-link :href="route('notes.index')" :active="request()->routeIs('notes.*')">{{ __('Заметки') }}</x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <div class="rounded-lg bg-indigo-50 px-3 py-1.5 text-sm font-medium text-indigo-700">{{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg border border-gray-200 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">Выйти</button>
                </form>
            </div>

            <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100 sm:hidden">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-indigo-100 bg-white sm:hidden">
        <div class="space-y-1 px-4 py-3">
            <x-responsive-nav-link :href="route('notes.index')" :active="request()->routeIs('notes.*')">{{ __('Заметки') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')">{{ __('Профиль') }}</x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-2 w-full rounded-lg border border-gray-200 px-3 py-2 text-left text-sm font-medium text-gray-700">Выйти</button>
            </form>
        </div>
    </div>
</nav>
