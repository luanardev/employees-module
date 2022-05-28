@component('mail::message')
<h2>Dear {{$staff->name()}}</h2>

<p>Please be advised that your CONTRACT will be TERMINATED on {{$staff->employment->endDate()}}.</p>
<p>Below is the information pertaining your contract.</p>
<p>
    Position: <strong>{{$staff->employment->getPosition()}}</strong> <br/>
    Starting Date: <strong>{{$staff->employment->startDate()}}</strong> <br/>
    Contract Period: <strong>{{$staff->employment->contractPeriod()}}</strong><br/>
    Remaining Period: <strong>{{$staff->employment->remainingPeriod()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
