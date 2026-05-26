<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="relative flex min-h-screen items-center justify-center bg-gradient-to-b from-slate-100 via-slate-50 to-white px-4 py-10">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.12),transparent_45%)]"></div>
            <div class="relative w-full max-w-md">
                <div class="mb-6 text-center">
                    <a href="/" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white/90 px-4 py-2 shadow-sm">
                        <x-application-logo class="h-6 w-6 fill-current text-indigo-600" />
                        <span class="text-sm font-semibold text-slate-700">Notes</span>
                    </a>
                </div>
                <div class="ui-surface w-full overflow-hidden px-6 py-6 sm:px-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>