@extends('layouts.app')

@section('title', 'About - ' . config('brand.name', 'Kattile'))

@section('page_title', 'About')

@section('page_subtitle')
    About {{ config('brand.name', 'Kattile') }} and its application identity.
@endsection

@section('content')
    <div class="sa-page">

        <section class="sa-card">
            <div class="sa-card-header">
                <h2>{{ config('brand.name', 'Kattile') }}</h2>
            </div>

            <div class="sa-card-body">
                <p>
                    <strong>{{ config('brand.name', 'Kattile') }}</strong>
                    is a Laravel-based application skeleton designed for clean,
                    professional, and reusable app development.
                </p>

                <p>
                    Version: <strong>{{ config('brand.version', '1.0.0') }}</strong>
                </p>

                <p>
                    Manufacturer:
                    <strong>{{ config('brand.manufacturer', 'Kattile') }}</strong>
                </p>

                <p>
                    {{ config('brand.description', 'A Laravel application built using Kattile.') }}
                </p>
            </div>
        </section>

    </div>
@endsection