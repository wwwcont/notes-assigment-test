<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Notes') }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script
    defer
    src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
></script>

<style>
    [x-cloak] {
        display: none !important;
    }

    body {
        background:
            radial-gradient(circle at top left, rgba(99,102,241,0.08), transparent 30%),
            radial-gradient(circle at bottom right, rgba(236,72,153,0.06), transparent 30%),
            #f8fafc;
    }

    .ui-surface {
        border-radius: 1.25rem;
        border: 1px solid rgb(226 232 240);
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(10px);
        box-shadow:
            0 1px 2px rgba(15,23,42,0.04),
            0 8px 24px rgba(15,23,42,0.04);
    }

    .ui-input {
        width: 100%;
        border-radius: 0.9rem;
        border: 1px solid rgb(203 213 225);
        background: white;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        color: rgb(15 23 42);
        transition: all 0.2s ease;
        outline: none;
    }

    .ui-input:focus {
        border-color: rgb(99 102 241);
        box-shadow:
            0 0 0 4px rgba(99,102,241,0.12);
    }

    .ui-btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.9rem;
        background: rgb(15 23 42);
        padding: 0.75rem 1.1rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        transition: all 0.2s ease;
        box-shadow:
            0 4px 14px rgba(15,23,42,0.12);
    }

    .ui-btn-primary:hover {
        transform: translateY(-1px);
        background: rgb(30 41 59);
        box-shadow:
            0 10px 22px rgba(15,23,42,0.16);
    }

    .ui-btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.9rem;
        border: 1px solid rgb(203 213 225);
        background: white;
        padding-left: 1rem;
        padding-right: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: rgb(51 65 85);
        transition: all 0.2s ease;
    }

    .ui-btn-secondary:hover {
        background: rgb(248 250 252);
        border-color: rgb(148 163 184);
    }

    .ui-btn-danger {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.9rem;
        border: 1px solid rgb(254 202 202);
        background: rgb(254 242 242);
        padding-left: 1rem;
        padding-right: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: rgb(185 28 28);
        transition: all 0.2s ease;
    }

    .ui-btn-danger:hover {
        background: rgb(254 226 226);
        border-color: rgb(252 165 165);
    }
</style>

</head>

<body class="min-h-screen text-slate-800 antialiased">

<div class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
    @yield('content')
</div>


</body>
</html>
