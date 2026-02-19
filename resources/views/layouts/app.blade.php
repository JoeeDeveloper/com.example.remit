<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="REMIT events data published for wholesale energy market integrity and transparency compliance.">
    <title>@yield('title', 'REMIT Events') - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|jetbrains-mono:400,500" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root {
            --font-sans: 'DM Sans', ui-sans-serif, system-ui, sans-serif;
            --font-mono: 'JetBrains Mono', ui-monospace, monospace;
            --color-bg: #0f1419;
            --color-surface: #1a222d;
            --color-surface-elevated: #24303f;
            --color-border: #2d3a4a;
            --color-text: #e6edf3;
            --color-text-muted: #8b9cb3;
            --color-accent: #00d4aa;
            --color-accent-dim: #00a884;
            --color-warning: #f0b429;
            --color-danger: #f85149;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen bg-[#0f1419] text-[#e6edf3] antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="border-b border-[#2d3a4a] bg-[#1a222d]/80 backdrop-blur-sm sticky top-0 z-10">
            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold tracking-tight font-[family-name:var(--font-sans)]">
                            REMIT Events
                        </h1>
                        <p class="text-sm text-[#8b9cb3] mt-0.5">
                            Wholesale energy market transparency
                        </p>
                    </div>
                    <a href="https://bmrs.elexon.co.uk/remit" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-2 text-sm text-[#00d4aa] hover:text-[#00a884] transition-colors">
                        <span>Elexon BMRS Data</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>
        </header>

        <main class="flex-1 max-w-[1600px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
            @yield('content')
        </main>

        <footer class="border-t border-[#2d3a4a] bg-[#1a222d] mt-auto">
            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <p class="text-xs text-[#8b9cb3] leading-relaxed max-w-3xl">
                    Information made available under REMIT. This data is published in compliance with
                    <strong>Regulation (EU) No 1227/2011</strong> of the European Parliament and of the Council
                    of 25 October 2011 on wholesale energy market integrity and transparency (Article 4).
                </p>
                <p class="text-xs text-[#6b7a8f] mt-3">
                    © {{ date('Y') }} {{ config('app.name') }}
                </p>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
