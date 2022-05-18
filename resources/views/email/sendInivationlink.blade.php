@component('mail::message')
    Hello!
    @component('mail::button', ['url' => $route])
        View Invitation
    @endcomponent
    You have invitation link please join


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
