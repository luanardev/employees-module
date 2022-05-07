@component('mail::message')
<h2>Dear {{$employee->name()}}</h2>

<p>Please be advised that your RETIREMENT will be on {{$employee->employment->endDate()}}.</p>
<p>Below is the information pertaining your tenure.</p>
<p>
    Designation: <strong>{{$employee->employment->getDesignation()}}</strong> <br/>
    Starting Date: <strong>{{$employee->employment->startDate()}}</strong> <br/>
    Period of Service: <strong>{{$employee->employment->elapsedPeriod()}}</strong> <br/>
    Remaining Period: <strong>{{$employee->employment->remainingPeriod()}}</strong> <br/>
    Current Age: <strong>{{$employee->age()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
