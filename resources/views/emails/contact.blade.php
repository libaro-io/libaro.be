@component('mail::message')
# Er werd een nieuw bericht doorgestuurd via het contactformulier op libaro.be

@component('mail::panel')
- ***Name:*** {{ $name }}
- ***Email:*** {{ $email }}
- ***Bericht:***

{{ $message }}

@endcomponent
