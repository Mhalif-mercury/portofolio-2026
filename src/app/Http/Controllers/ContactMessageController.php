<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $ip = $request->ip();

        if (RateLimiter::tooManyAttempts('contact:' . $ip, 3)) {
            $seconds = RateLimiter::availableIn('contact:' . $ip);

            return back()->withErrors([
                'rate' => 'Too many attempts. Please try again in ' . ceil($seconds / 60) . ' minutes.',
            ])->with('error', 'Too many attempts. Please try again later.');
        }

        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:255'],
            'message' => ['required'],
        ]);

        ContactMessage::create($validated);

        RateLimiter::hit('contact:' . $ip, 600);

        return back()->with(
            'success',
            'Message sent successfully! I will get back to you as soon as possible.'
        );
    }
}
