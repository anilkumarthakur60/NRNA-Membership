@component('mail::message')
    Hello!
    Your password is 
    
    {{$password}}


    Thanks,
    {{ config('app.name') }}
@endcomponent
