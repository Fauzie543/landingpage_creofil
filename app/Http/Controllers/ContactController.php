<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Feedbacks;

class ContactController extends Controller
{
    public function show()
    {
        $company = Company::first(); // Hanya satu company (sudah dijaga di model)
        return view('pages.contact', compact('company'));
    }
    public function submitFeedback(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        Feedbacks::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => 'pending', // default status
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }
}