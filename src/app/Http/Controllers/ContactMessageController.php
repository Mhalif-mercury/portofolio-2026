<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => ['required', 'max:255'],

            'email' => ['required', 'email'],

            'subject' => ['required', 'max:255'],

            'message' => ['required'],

        ]);

        ContactMessage::create($validated);

        return back()->with(
            'success',
            'Message sent successfully.'
        );
    }
}
