<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/docs', 'pages.docs')->name('docs');
Route::view('/about', 'pages.about')->name('about');