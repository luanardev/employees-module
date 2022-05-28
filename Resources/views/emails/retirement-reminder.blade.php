@component('mail::message')
<h2>Dear {{$staff->name()}}</h2>

<p>Please be advised that your RETIREMENT will be on {{$staff->employment->endDate()}}.</p>
<p>Below is the information pertaining your tenure.</p>
<p>
    Position: <strong>{{$staff->employment->getPosition()}}</strong> <br/>
    Starting Date: <strong>{{$staff->employment->startDate()}}</strong> <br/>
    Period of Service: <strong>{{$staff->employment->elapsedPeriod()}}</strong> <br/>
    Remaining Period: <strong>{{$staff->employment->remainingPeriod()}}</strong> <br/>
    Current Age: <strong>{{$staff->age()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
