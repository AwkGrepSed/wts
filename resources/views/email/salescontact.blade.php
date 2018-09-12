@component('mail::message')
# New Contact

Please reach out and see how we can help!

* Company:  {{ $contact->company }}
* Person:   {{ $contact->person  }}
* Email:    {{ $contact->email   }}
* Phone:    {{ $contact->phone   }}

* Message:  {{ $contact->message }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
