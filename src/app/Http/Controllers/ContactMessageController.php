<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $ip = $request->ip();

        if (RateLimiter::tooManyAttempts('contact:' . $ip, 3)) {
            $seconds = RateLimiter::availableIn('contact:' . $ip);

            return redirect(route('blog.index') . '#contact')->withErrors([
                'rate' => 'Too many attempts. Please try again in ' . ceil($seconds / 60) . ' minutes.',
            ])->with('error', 'Too many attempts. Please try again later.');
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:255'],
            'message' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect(route('blog.index') . '#contact')
                ->withErrors($validator)
                ->withInput();
        }

        ContactMessage::create($validator->validated());

        RateLimiter::hit('contact:' . $ip, 600);

        return redirect(route('blog.index') . '#contact')->with(
            'success',
            'Message sent successfully! I will get back to you as soon as possible.'
        );
    }
}
