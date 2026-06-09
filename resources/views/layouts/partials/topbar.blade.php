<header class="sa-topbar">
    <div class="sa-topbar-left">
        <h1 class="sa-page-title">
            @yield('page_title', config('brand.name'))
        </h1>
        <div class="sa-page-subtitle">
            @yield('page_subtitle', config('brand.description'))
        </div>
    </div>
    <div class="sa-topbar-actions">
        @yield('topbar_actions')
    </div>
</header>