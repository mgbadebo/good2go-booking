<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Create contact message record
        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'] ?? 'General Inquiry',
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        // Send email to info@good2go.ng
        try {
            Mail::to('info@good2go.ng')->send(new ContactFormSubmitted($contactMessage));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact form email: ' . $e->getMessage());
        }

        return back()->with('contact_success', true);
    }
}
