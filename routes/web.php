<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.landing-page');
});

Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/book', function () {
    return view('public.book');
})->name('book');

Route::get('/service', function () {
    return view('public.service');
})->name('service');

Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

Route::get('/dashboardadmin', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/koleksiadmin', function () {
    return view('admin.koleksi');
})->name('koleksi');
