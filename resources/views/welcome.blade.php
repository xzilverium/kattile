@extends('layouts.app')

@section('title', config('brand.name', 'Kattile'))

@section('page_title')
    {{ config('brand.name', 'Kattile') }}
@endsection

@section('page_subtitle')
    {{ config('brand.description', 'A Laravel application built using Kattile.') }}
@endsection

@section('content')
    <div class="sa-page">

        <section class="sa-card">
            <div class="sa-card-header">
                <h2>Welcome</h2>
            </div>

            <div class="sa-card-body">
                <p>
                    Welcome to <strong>{{ config('brand.name', 'Kattile') }}</strong>.
                </p>

                <p>
                    Version: <strong>{{ config('brand.version', '1.0.0') }}</strong>
                </p>

                <p>
                    Manufacturer:
                    <strong>{{ config('brand.manufacturer', config('brand.name', 'Kattile')) }}</strong>
                </p>

                <p>
                    {{ config('brand.description', 'A Laravel application built using Kattile.') }}
                </p>
            </div>
        </section>

        <section class="sa-card">
            <div class="sa-card-header">
                <h2>System Information</h2>
            </div>

            <div class="sa-card-body">
                <ul>
                    <li>PHP {{ PHP_VERSION }}</li>
                    <li>Laravel {{ app()->version() }}</li>
                    <li>Environment: {{ app()->environment() }}</li>
                </ul>
            </div>
        </section>

    </div>
@endsection