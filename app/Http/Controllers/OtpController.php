<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    public function showPhone()
    {
        return view('auth.otp-phone');
    }

    public function showEmail()
    {
        return view('auth.otp-email');
    }

    public function showValidate()
    {
        return view('auth.validate-otp');
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        $otp = rand(100000, 999999);

        Session::put('otp_code', (string)$otp);
        Session::put('otp_target', $request->phone);
        Session::put('otp_method', 'sms');

        $response = Http::withoutVerifying()
            ->withToken(env('REPOHIVE_API_KEY'))
            ->acceptJson()
            ->timeout(30)
            ->post(rtrim(env('REPOHIVE_API_BASE'), '/') . '/messages', [
                'phone' => $request->phone,
                'message' => 'Your RepoHive OTP code is: ' . $otp . '. Do not share this code with anyone.',
            ]);

        if ($response->successful()) {
            return redirect()->route('otp.validate')
                ->with('success', 'OTP sent to ' . $request->phone);
        }

        return back()->with('error', 'Failed to send OTP. Error: ' . $response->body());
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $otp = rand(100000, 999999);
        $cooldownSeconds = 60;
        $lastSentAt = Session::get('otp_sent_at');

        if ($lastSentAt && (time() - $lastSentAt) < $cooldownSeconds) {
            $secondsLeft = $cooldownSeconds - (time() - $lastSentAt);
            return back()->withInput()->with('error', 'Please wait ' . $secondsLeft . ' seconds before requesting another OTP.');
        }

        Session::put('otp_code', (string)$otp);
        Session::put('otp_target', $request->email);
        Session::put('otp_method', 'email');

        $baseUrl = config('services.repohive_email.base_url');
        $token = config('services.repohive_email.token');

        if (!$baseUrl || !$token) {
            return back()->withInput()->with('error', 'Email API is not configured.');
        }

        $response = Http::withoutVerifying()
            ->withToken($token)
            ->acceptJson()
            ->timeout(30)
            ->post(rtrim($baseUrl, '/') . '/email/send', [
                'to' => $request->email,
                'subject' => 'Your RepoHive Verification Code',
                'html' => '<p>Your RepoHive verification code is <strong>' . $otp . '</strong>. Do not share this with anyone!</p>',
                'text' => 'Your RepoHive verification code is: ' . $otp . '. Do not share this with anyone!',
            ]);

        if (!$response->successful()) {
            $errorBody = $response->json();
            $error = Arr::get($errorBody, 'error.message') ?? Arr::get($errorBody, 'message') ?? $response->body();

            return back()->withInput()->with('error', 'Email failed: ' . (is_string($error) ? $error : json_encode($error)));
        }

        Session::put('otp_sent_at', time());

        return redirect()->route('otp.validate')
            ->with('success', 'OTP sent to ' . $request->email);
    }

    public function validateOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string'
        ]);

        $sessionOtp = Session::get('otp_code');

        if ((string)$request->otp === (string)$sessionOtp) {
            Session::put('otp_verified', true);
            return redirect()->route('mailbox')
                ->with('success', 'OTP verified successfully!');
        }

        return back()->with('error', 'Invalid OTP. Please try again.');
    }
}