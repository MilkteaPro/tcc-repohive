<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('auth.login'))->name('login');
Route::get('/otp-phone', fn() => view('auth.otp-phone'))->name('otp.phone');
Route::get('/otp-email', fn() => view('auth.otp-email'))->name('otp.email');
Route::get('/validate-otp', fn() => view('auth.validate-otp'))->name('otp.validate');
Route::get('/mailbox', fn() => view('mailbox.index'))->name('mailbox');
Route::get('/chatbot', fn() => view('chatbot.index'))->name('chatbot');