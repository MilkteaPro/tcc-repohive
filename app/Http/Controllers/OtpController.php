<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REPOHIVE_API_KEY'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(env('REPOHIVE_API_BASE') . '/messages', [
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

        Session::put('otp_code', (string)$otp);
        Session::put('otp_target', $request->email);
        Session::put('otp_method', 'email');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REPOHIVE_API_KEY'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(env('REPOHIVE_API_BASE') . '/email/send', [
            'email' => $request->email,
            'subject' => 'Your RepoHive OTP Code',
            'message' => 'Your OTP code is: ' . $otp . '. Do not share this code with anyone.',
        ]);

        if ($response->successful()) {
            return redirect()->route('otp.validate')
                ->with('success', 'OTP sent to ' . $request->email);
        }

        return back()->with('error', 'Failed to send OTP. Error: ' . $response->body());
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