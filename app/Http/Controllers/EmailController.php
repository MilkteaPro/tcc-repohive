<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = $validated['email'];

        // Generate random OTP
        $otp = rand(100000, 999999);

        // Store OTP in session
        Session::put('otp_code', $otp);
        Session::put('otp_target', $email);
        Session::put('otp_method', 'email');

        $response = Http::withToken(config('services.repohive_email.token'))
            ->acceptJson()
            ->timeout(30)
            ->post(
                rtrim(config('services.repohive_email.base_url'), '/') . '/email/send',
                [
                    'to' => $email,
                    'subject' => 'Your RepoHive Verification Code',
                    'html' => '<p>Your RepoHive verification code is <strong>' . $otp . '</strong>. Do not share this to anyone!</p>',
                    'text' => 'Your RepoHive verification code is: ' . $otp . '. Do not share this to anyone!',
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
                ->with('success', 'OTP sent to ' . $email);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email.',
                'error' => $response->json(),
            ], 500);
        }

        return back()
            ->withInput()
            ->with('email_error', 'Failed to send OTP. Please try again.');
    }
}