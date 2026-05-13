<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\EmailController;

Route::get('/', fn() => view('auth.login'))->name('login');
Route::get('/otp-phone', [OtpController::class, 'showPhone'])->name('otp.phone');
Route::get('/otp-email', [OtpController::class, 'showEmail'])->name('otp.email');
Route::get('/validate-otp', [OtpController::class, 'showValidate'])->name('otp.validate');
Route::get('/mailbox', fn() => view('mailbox.index'))->name('mailbox');
Route::get('/chatbot', fn() => view('chatbot.index'))->name('chatbot');

Route::post('/otp-phone', [OtpController::class, 'sendSms'])->name('otp.send.sms');
Route::post('/otp-email', [OtpController::class, 'sendEmail'])->name('otp.send.email');
Route::post('/validate-otp', [OtpController::class, 'validateOtp'])->name('otp.verify');

Route::post('/otp/phone', [SmsController::class, 'sendSms'])->name('otp.phone.send');
Route::post('/otp/email', [EmailController::class, 'sendEmail'])->name('otp.email.send');