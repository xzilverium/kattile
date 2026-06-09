<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('brand.name', config('app.name', 'Kattile')))</title>
    <meta name="description" content="{{ config('brand.description', '') }}">
    <meta name="manufacturer" content="{{ config('brand.manufacturer', '') }}">
    <meta name="app-version" content="{{ config('brand.version', '1.0.0') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('icon.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
        }
        body.sa-body {
            min-height: 100vh;
            overflow: hidden;
        }
        .sa-app {
            width: 100%;
            height: 100vh;
            display: grid !important;
            grid-template-columns: 280px minmax(0, 1fr) !important;
            overflow: hidden;
        }
        .sa-app-sidebar {
            width: 280px;
            height: 100vh;
            overflow: hidden;
        }
        .sa-app-main {
            min-width: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .sa-app-content {
            flex: 1;
            min-width: 0;
            overflow-y: auto;
            padding: 32px;
        }
        .sa-app-content > .sa-page {
            max-width: 1100px;
            margin: 0 auto;
        }
        .sa-app-footer {
            flex: 0 0 auto;
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            font-size: 13px;
            opacity: 0.75;
        }
        @media (max-width: 900px) {
            body.sa-body {
                overflow: auto;
            }
            .sa-app {
                height: auto;
                min-height: 100vh;
                grid-template-columns: 1fr !important;
            }
            .sa-app-sidebar {
                width: 100%;
                height: auto;
            }
            .sa-app-main {
                height: auto;
                min-height: 100vh;
            }
            .sa-app-content {
                padding: 20px;
            }
            .sa-app-footer {
                padding: 14px 20px;
                flex-direction: column;
                align-items: flex-start;
            }
            }
            .sa-topbar {
                min-height: 72px;
                padding: 18px 32px;
            }

            @media (max-width: 768px) {
                .sa-topbar {
                padding: 16px 20px;
                }
            }
    </style>
    @stack('styles')
</head>
<body class="sa-body">
    <div class="sa-app">
        <div class="sa-app-sidebar">
            @include('layouts.partials.sidebar')
        </div>
        <div class="sa-app-main">
            @include('layouts.partials.topbar')
            <main class="sa-app-content">
                @yield('content')
            </main>
            <footer class="sa-app-footer">
                <span>
                    © {{ date('Y') }} {{ config('brand.manufacturer', config('brand.name', 'Kattile')) }}
                </span>
                <span>
                    {{ config('brand.name', 'Kattile') }} v{{ config('brand.version', '1.0.0') }}
                </span>
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>
</html>