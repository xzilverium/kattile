@extends('layouts.app')

@section('title', 'Docs - ' . config('brand.name', 'Kattile'))

@section('page_title', 'Documentation')

@section('page_subtitle')
    Learn how to build applications using {{ config('brand.name', 'Kattile') }}.
@endsection

@section('content')
    <div class="sa-page">

        <section class="sa-card">
            <div class="sa-card-header">
                <h2>Getting Started</h2>
            </div>

            <div class="sa-card-body">
                <p>
                    {{ config('brand.name', 'Kattile') }} is a Laravel-based application skeleton
                    designed for building clean, professional, and scalable apps.
                </p>

                <p>Start by configuring your application identity in:</p>

                <pre><code>config/brand.php</code></pre>
            </div>
        </section>

        <section class="sa-card">
            <div class="sa-card-header">
                <h2>Brand Configuration</h2>
            </div>

            <div class="sa-card-body">
                <p>
                    The brand file controls the app name, version, description,
                    manufacturer, and icon path.
                </p>

<pre><code>&lt;?php

return [
    'name' => env('BRAND_NAME', 'Kattile'),
    'version' => env('BRAND_VERSION', '26.6.1'),
    'description' => env('BRAND_DESCRIPTION', 'The skeleton for Kattile Apps.'),
    'manufacturer' => env('BRAND_MANUFACTURER', 'Xzilverium Realms'),
    'icon' => env('BRAND_ICON', 'icon.svg'),
];</code></pre>
            </div>
        </section>

        <section class="sa-card">
            <div class="sa-card-header">
                <h2>Layout Structure</h2>
            </div>

            <div class="sa-card-body">
<pre><code>resources/views/layouts/app.blade.php
resources/views/layouts/partials/sidebar.blade.php
resources/views/layouts/partials/topbar.blade.php</code></pre>
            </div>
        </section>

    </div>
@endsection