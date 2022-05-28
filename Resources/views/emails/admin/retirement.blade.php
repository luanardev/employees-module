@component('mail::message')
<h2>Dear Admin</h2>

<p>Please be advised that {{ $staff->fullname() }} is now RETIRED from the post of {{$staff->employment->getPosition()}}</p>
<p>Below is the information pertaining the retirement</p>
<p>
    Starting Date: <strong>{{$staff->employment->startDate()}}</strong> <br/>
    Period of Service: <strong>{{$staff->employment->elapsedPeriod()}}</strong> <br/>
    Grade Scale: <strong>{{$staff->employment->getScale()}}</strong><br/>
    Current Age: <strong>{{$staff->age()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
