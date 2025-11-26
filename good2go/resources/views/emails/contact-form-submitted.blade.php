@component('mail::message')
# New Contact Form Submission

You have received a new message from the Good2Go contact form.

**Name:** {{ $contactMessage->name }}  
**Email:** {{ $contactMessage->email }}  
**Phone:** {{ $contactMessage->phone }}  
**Subject:** {{ $contactMessage->subject ?? 'General Inquiry' }}

**Message:**
{{ $contactMessage->message }}

---
This message was sent from the Good2Go website contact form.
@endcomponent

