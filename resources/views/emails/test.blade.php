{{-- resources/views/emails/test.blade.php --}}
@component('mail::message')
# Hello!

This is a test email from Laravel Queue.

Thanks,<br>
{{ config('app.name') }}
@endcomponent