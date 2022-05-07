@component('mail::message')
<h2>Dear {{$employee->name()}}</h2>

<p>Please be advised that your CONTRACT IS TERMINATED.</p>
<p>Below is the information pertaining your contract.</p>
<p>
    Designation: <strong>{{$employee->employment->getDesignation()}}</strong> <br/>
    Starting Date: <strong>{{$employee->employment->startDate()}}</strong> <br/>
    Ending Date: <strong>{{$employee->employment->startDate()}}</strong> <br/>
    Contract Period: <strong>{{$employee->employment->contractPeriod()}}</strong><br/>
</p>

{{ config('app.name') }}
@endcomponent
