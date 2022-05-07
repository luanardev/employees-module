@component('mail::message')
<h2>Dear {{$employee->name()}}</h2>

<p>We are pleased to offer you a CONFIRMATION OF EMPLOYMENT. You are now a permanent staff member of {{ config('app.name') }}.</p>
<p>
    Confirmed Position: <strong>{{$employee->employment->getDesignation()}}</strong> <br/>
    Confirmation Date: <strong>{{$employee->employment->startDate()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
