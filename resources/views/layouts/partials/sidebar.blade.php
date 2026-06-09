<aside class="sa-sidebar">
    <div class="sa-brand">
        <img
            src="{{ asset(config('brand.icon', 'icon.svg')) }}"
            alt="{{ config('brand.name', 'Kattile') }}"
            class="sa-brand-icon"
        >
        <div class="sa-brand-text">
            <div class="sa-brand-name">
                {{ config('brand.name', 'Kattile') }}
            </div>
            <div class="sa-brand-version">
                v{{ config('brand.version', '1.0.0') }}
            </div>
        </div>
    </div>

    <nav class="sa-sidebar-nav" aria-label="Primary navigation">
        <a href="{{ route('home') }}" class="sa-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">
            Home
        </a>
        <a href="{{ route('docs') }}" class="sa-nav-link {{ request()->routeIs('docs') ? 'is-active' : '' }}">
            Docs
        </a>
        <a href="{{ route('about') }}" class="sa-nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}">
            About
        </a>
    </nav>

    <div class="sa-sidebar-footer">
        {{ config('brand.manufacturer', config('brand.name', 'Kattile')) }}
    </div>
</aside>