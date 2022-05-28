@component('mail::message')
<h2>Dear {{$staff->name()}}</h2>

<p>We are pleased to offer you a CONFIRMATION OF EMPLOYMENT. You are now a permanent staff member of {{ config('app.name') }}.</p>
<p>
    Confirmed Position: <strong>{{$staff->employment->getPosition()}}</strong> <br/>
    Confirmation Date: <strong>{{$staff->employment->startDate()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
