<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SmsController extends Controller
{
    public function sendSms(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:30'],
        ]);

        $phone = $validated['phone'];

        // Generate RANDOM 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP in session
        Session::put('otp_code', $otp);
        Session::put('otp_target', $phone);
        Session::put('otp_method', 'phone');

        $response = Http::withToken(config('services.repohive_sms.token'))
            ->acceptJson()
            ->timeout(30)
            ->post(
                rtrim(config('services.repohive_sms.base_url'), '/') . '/messages',
                [
                    'phone' => $phone,
                    'message' => 'Your RepoHive verification code is: ' . $otp . '. Do not share this to anyone!',
                ]
            );

        if ($response->successful()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json(),
                ]);
            }

            return redirect()
                ->route('otp.validate')
                ->with('success', 'OTP sent to ' . $phone);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send SMS.',
                'error' => $response->json(),
            ], 500);
        }

        return back()
            ->withInput()
            ->with('sms_error', 'Failed to send OTP. Please try again.');
    }
}